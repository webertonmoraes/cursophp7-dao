<?php
require_once("config.php");

$sql = new Sql('localhost', 'dbphp7', 'root', '');
$result = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($result);

$insert = $sql->insert("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :PASS)", array (":LOGIN" =>"NOVOLOGIN2", ":PASS" => "NOVAPASS2"));
?>