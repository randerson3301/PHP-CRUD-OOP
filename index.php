<?php 
    //variaveis para paginação
    
    //caso o parametro page esteja nulo na URL, o valor padrão será 1
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    
    //numero de registros por página
    $recs_per_page = 5;

    //calculo para definir o limite da claúsula LIMIT no SQL
    $from_rec_num = ($recs_per_page * $page) - $recs_per_page; 
    
    //arquivos de banco de dados e objetos
    include_once 'config/database.php';
    include_once 'class/produto.php';
    include_once 'class/categoria.php';

    //cabeçalho da page
    $page_title = "Ver Produtos";
    require_once("layout_files/header.php");

    //instanciação de objetos e database
    $database = new Database();
    $db = $database->getConnection();

    $produto = new Produto($db);
    $categ = new Categoria($db);

    //consulta de produtos
    $stmt = $produto->readAll($from_rec_num, $recs_per_page);
   

    $num = $stmt->rowCount();

    //content
    echo "<div class='right-button-margin'>";
        echo "<a href='cadastro_produto.php' class='btn btn-default pull-right'>Cadastrar 
        Produto</a>";
    echo "</div>";  

    //mostra produtos casa haja algum
    if($num > 0){

        //header da tabela que irá se formar
        echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Nome</th>";
            echo "<th>Preço</th>";
            echo "<th>Descrição</th>";
            echo "<th>Categoria</th>";
            echo "<th>Ações</th>";
        echo "</tr>";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            echo "<tr>";
                echo "<td>{$c_nomeprod}</td>";
                echo "<td>{$n_precoprod}</td>";
                echo "<td>{$c_descprod}</td>";
                echo "<td>";
                    $categ->id = $n_idcateg;
                    $categ->readName();
                    echo $categ->name;
                echo "</td>";

                echo "<td>";
                    // ações irão aparecer aqui
                    echo "<a href='read_one.php?id={$n_idprod}' class='btn btn-primary left-margin'>
                            <span class='glyphicon glyphicon-list'></span> Ver
                        </a>
                    
                        <a href='update_product.php?id={$n_idprod}' class='btn btn-info left-margin'>
                            <span class='glyphicon glyphicon-edit'></span> Editar
                        </a>
                    
                        <a delete-id='{$n_idprod}' class='btn btn-danger delete-object'>
                            <span class='glyphicon glyphicon-remove'></span> Excluir
                        </a>";
                echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

        $page_url = "index.php?"; //nome da page
        $total_rows = $produto->countAll();

    //paging btns
    include_once 'paging.php';

    } else {
        echo "<div class='alert alert-info'>Nenhum produto encontrado.</div>";
    }

    //footer da page
    require_once("layout_files/footer.php");
?>