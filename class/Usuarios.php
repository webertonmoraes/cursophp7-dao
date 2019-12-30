<?php

class Usuarios {
    private $idusuarios;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;
    
    function __construct($deslogin = '', $dessenha = '') {
        $this->deslogin = $deslogin;
        $this->dessenha = $dessenha;
    }

        public function getIdusuarios()//PEGA O VALOR DO IDUSUARIO
    {
        return $this->idusuarios;
    }

    public function setIdusuarios($idusuarios)//SETA O VALOR DO IDUSUARIO NO ATRIBUTO
    {
        $this->idusuarios = $idusuarios;
    }

    public function getDeslogin()//PEGA O VALOR DO ATRIBUTO DESLOGIN
    {
        return $this->deslogin;
    }

    public function setDeslogin($deslogin)//SETA O VALOR DO ATRIBUTO DESLOGIN
    {
        $this->deslogin = $deslogin;
    }

    public function getDessenha()//PEGA O VALOR QUE ESTÁ NO ATRIBUTO DESSENHA
    {
        return $this->dessenha;
    }

    public function setDessenha($dessenha)//SETA O VALOR PARA O ATRIBUTO DESSENHA
    {
        $this->dessenha = $dessenha;
    }

    public function getDtcadastro()//RETORNA O VALOR DO ATRIBUTO DTCADASTRO
    {
        return $this->dtcadastro;
    }

    public function setDtcadastro($dtcadastro)//SETA O VALOR PARA O DTCADASTRO
    {
        $this->dtcadastro = $dtcadastro;
    }

    
    //DADOS DOS SET DOS USUARIOS
    public function setData($data) {
        $this->setIdusuarios($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }
    
    //METODO PARA PEGAR O ID E RETORNAR OS DADOS DO BANCO
    //PREENCHE OS ATRIBUTOS COM OS DADOS QUE ESTÃO NO BANCO DE DADOS
    //USANDO OS METODOS SET
    public function loadById($id){
        $sql = new Sql("localhost", "dbphp7", "root", "");
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :id", array(":id" => "$id"));
        if(count($results) > 0){
            $row = $results[0];
            $this->setIdusuarios($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
    }

    //METADO MAGICO PARA TRANSFORMAR O OBJETO EM STRING
    //RETORNA OS VALORE EM ARRAY EM UM JSON
    //ULTILIZA OS METADOS GET PARA PEGAR OS VALORES QUE ESTÃO ARMAZENADOS NOS ATRIBUTOS
    //PARA JOGAR NA TELA
    public function __toString(){
        return json_encode(array(
            "idusuario" => $this->getIdusuarios(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d-m-Y H:i:s")
        ));
    }
    
    
    //METODO DE PESQUISA
    static function search($login) {
        $sql = new Sql("localhost", "dbphp7", "root", "");
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ':SEARCH' => "%".$login."%"
        ));
    }
    
    
    //EXIBE LISTA DO BANCO POR ONDEM ALFABETICA DE LOGIN
    static function getList(){
        $sql = new Sql("localhost", "dbphp7", "root", "");
        return $sql ->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }
    
    
    //CONFERE LOGIN E SENHA NO BANCO
    public function login($login, $pass) {
        $sql = new Sql("localhost", "dbphp7", "root", "");
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASS", array(
            ":LOGIN" => $login,
            ":PASS" => $pass
        ));
        
        if (count($results) > 0){
            $data = $results[0];
            $this->setData($results[0]);
        } else {
            throw new Exception("Login e/ou senha incorreto!");
        }
    }
    
    //INSERT
    public function insert() {
        $sql = new Sql("localhost", "dbphp7", "root", "");
        $sql->query("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :PASS)", array(
            ":LOGIN" => $this->getDeslogin(),
            ":PASS" => $this->getDessenha()
        ));
        
    }
    
    
    //INSERT PROCEDURE
    public function insertProcedure() {
        $sql = new Sql("localhost", "dbphp7", "root", "");
        $results = $sql->select("CALL sp_usuarios_insert (:LOGIN, :PASS)", array(
            ":LOGIN" => $this->getDeslogin(),
            ":PASS" => $this->getDessenha()
        ));
        if(count($results) > 0){
            $this->setData($results[0]);
        }else{
            echo 'batata';
        }
    }
    
    //UPDATE
    public function update( $id, $login, $pass) {
        
        
        $this->setDeslogin($login);
        $this->setDessenha($pass);
        $this->setIdusuarios($id);
        $sql = new Sql("localhost", "dbphp7", "root", "");
        
        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASS WHERE idusuario = :ID", array(
            ":LOGIN"=> $this->getDeslogin(),
            ":PASS"=> $this->getDessenha(),
            ":ID"=> $this->getIdusuarios()
        ));
    }
}