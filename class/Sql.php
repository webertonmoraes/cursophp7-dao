<?php

class Sql extends PDO {
    private $conn;

    public function __construct($host, $dbname, $user, $pass){
        $this->conn = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
    }

    private function setParams($statment, $parameters = array()){
        foreach ($parameters as $key => $value) {
            $this->setParam($statment, $key, $value);
        }
    }

    private function setParam($statment, $key, $value){
        $statment->bindParam($key, $value);
    }

    public function query ($query, $params = array()){
        $stmt = $this->conn->prepare($query);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;
    }

    public function select($query, $params = array()):array{
        $stmt = $this->query($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($query, $params = array()):array
    {
        $stmt = $this->query($query, $params);
    }

}


?>