<?php
require_once("config.php");

//$pokinha = new Usuarios();
//$pokinha->loadById(7);
//echo $pokinha;

//$list = Usuarios::getList();
//echo json_encode($list);

//Lista uma busca pelo login
//$search = Usuarios::search("pok");
//echo json_encode($search);

//Altenticação login e senha

$login = new Usuarios();
$login->login('pokebatera', 'batera05');
echo $login;