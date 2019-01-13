<?php 
class Categoria{

    //conexão com o banco e nome da table
    private $conn;
    private $tablename = "tbl_categoria";

    //atributos
    public $id;
    public $name;

    //construtor da classe
    public function __construct($db){
        $this->conn = $db;
    }

    //função utilizada para carregar o drop down de categorias
    function read(){
        //select de todos os registros
        $query = "SELECT n_idcateg, c_nomecat FROM ". $this->tablename ." ORDER BY c_nomecat";
        //preparando o comando sql
        $stmt = $this->conn->prepare($query);

        //executando a consulta
        $stmt->execute();

        //retorna os registros
        return $stmt;
    }

    //function para ler o nome da categoria pelo seu ID
    function readName(){
        $query = "SELECT c_nomecat FROM ". $this->tablename 
        ."WHERE n_idcateg = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['c_nomecat'];
    }
}    
?>