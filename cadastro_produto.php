<?php 
    //database e files dos objetos
    include_once 'config/database.php';
    include_once 'class/produto.php';
    include_once 'class/categoria.php';

    //conexão com o banco de dados
    $database = new Database();
    $db = $database->getConnection();

    //passando a conexao aos objetos
    $produto = new Produto($db);
    $categ = new Categoria($db);
    
    //page header 
    $page_title = "Cadastrar Produto";
    require_once("layout_files/header.php");

    //conteudo
    echo "<div class='right-button-margin'>";
        echo "<a href='index.php' class='btn btn-default pull-right'>Ver Produtos</a>";
    echo "</div>";
?>
    <!-- Criando o form para cadastro de produtos-->
    
    <!--
        ***************ANOTAÇÕES************************
       
        htmlspecialchars() -> converte caracteres especiais para html
        
        $_SERVER['PHP_SELF'] -> uma variavel super global que retorna o nome do arquivo 
        de script que está sendo executado. O beneficio é que o user irá ver mensagens 
        de erro na mesma página que está o formulário
        
        
    -->
    <?php
        //caso o form for acionado
        if($_POST){

            //setando valores de atributos
            $produto->name = $_POST['txtnome'];
            $produto->preco = $_POST['txtpreco'];
            $produto->desc = $_POST['txtdesc'];
            $produto->id_categ = $_POST['id_categ'];

            //registra o produto
            if($produto->create()){
                echo "<div class='alert alert-success'>Produto registrado com sucesso.</div>";
            }

            //mensagem de erro
            else{
                echo "<div class='alert alert-danger'>Produto não foi cadastrado.</div>";
            }
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        <table class="table  table-hover table-responsive table-bordered"> 
            <tr>
                <td>Nome</td>
                <td>
                    <input type="text" name="txtnome" class="form-control" />
                </td>
            </tr>

            <tr>
                <td>Preço</td>
                <td>
                    <input type="text" name="txtpreco" class="form-control" />
                </td>
            </tr>

            <tr>
                <td>Descrição</td>
                <td>
                    <textarea name="txtdesc" class="form-control"> </textarea>
                </td>
            </tr>

            <tr>
                <td>Categoria</td>
                <td>
                    <!-- categorias aparecerão pelo looping-->
                    <?php 
                        //lendo as categorias de produto do banco de dados
                        $stmt = $categ->read();

                        //var_dump($stmt);
                        //colocando elas em um select
                        
                        echo "<select class='form-control' name='id_categ'>";
                            echo "<option>Selecione a categoria...</option>";

                            while($row_categ = $stmt->fetch(PDO::FETCH_ASSOC)){
                                extract($row_categ);
                                /*
                                    variaveis abaixo são retiradas do nome do campo da table 
                                    de categorias
                                */
                                echo "<option value='{$n_idcateg}'>{$c_nomecat}</option>";
                                
                            }
                        echo "</select>";
                        
                        
                    ?>
                </td>
            </tr>

            <tr>
                <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">Salvar </button>
                    </td>
                </tr>
        </table>
    </form>
<?php
    require_once("layout_files/footer.php");
?>