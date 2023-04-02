<?php

Class Connection {

    private  $server = "mysql:host=localhost;dbname=appyogi";

    private  $user = "root";

    private  $pass = "";

    private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);

    protected $conn;
 
    public function openConnection()

    {

        try{

            $this->conn = new PDO($this->server, $this->user,$this->pass,$this->options);

            return $this->conn;

        }

        catch (PDOException $e){

            echo "There is some problem in connection: " . $e->getMessage();

        }

    }

    public function closeConnection() {

        $this->conn = null;

    }

}

?>