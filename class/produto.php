<?php 
class Produto{

    //conexão com banco e nome da tabela
    private $conn;
    private $table_name = "tbl_produtos";

    //atributos da classe
    public $id;
    public $name;
    public $preco;
    public $desc; //descrição do produto
    public $id_categ;
    public $timestamp;

    //construtor da classe
    public function __construct($db){
        $this->conn = $db;
    }

    //cadastrar produto
    function create(){

        //comando SQL
        //:nome -> quer dizer um parametro que está inserido no comando
        $query = "INSERT INTO
                ". $this->table_name . "
                SET
                c_nomeprod=:name, n_precoprod=:preco, c_descprod=:desc, 
                n_idcateg=:idcateg, d_criado=:criado";
        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->preco=htmlspecialchars(strip_tags($this->preco));
        $this->desc=htmlspecialchars(strip_tags($this->desc));
        $this->id_categ=htmlspecialchars(strip_tags($this->id_categ));
        $this->timestamp = date('Y-m-d H:i:s');

        //casando valores
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":preco", $this->preco);
        $stmt->bindParam(":desc", $this->desc);
        $stmt->bindParam(":idcateg", $this->id_categ);
        $stmt->bindParam(":criado", $this->timestamp);

        //condicional
        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        



    }
}
?>