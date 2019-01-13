<?php
class Database{
    //atributos
    private $host = "localhost";
    private $db_name = "db_produtos";
    private $username = "root";
    private $senha = "";
    public $conn;

    //fazendo a conexão com PDO
    public function getConnection(){
        $this->conn = null; //o this refere-se a classe Database, o atributo conn recebe null

        //usando try-catch para tentar fazer a conexão com o banco de dados
        try{
            #instanciando a class PDO e passando os devidos parametros para seu construtor
            $this->conn = new PDO("mysql:host=". $this->host . ";dbname=". $this->db_name, 
            $this->username, $this->senha);
            
            echo "Sucesso na conexão";
        }catch(PDOException $expt){
            //caso a conexão falhe, a mensagem de erro aparecerá no browser
            echo "Falha de conexão: " . $expt->getMessage();
        }

        //retorna da função será a conexão
        return $this->conn;

    }
}
?>