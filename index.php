<?php
require_once("config.php");

//$pokinha = new Usuarios();
//$pokinha->loadById(11);
//echo $pokinha;

//$list = Usuarios::getList();
//echo json_encode($list);

//Lista uma busca pelo login
//$search = Usuarios::search("pok");
//echo json_encode($search);

//Altenticação login e senha
//$login = new Usuarios();
//$login->login('pokebatera', 'batera05');
//echo $login;

//INSERIR NOVO USUARIO
//$novo = new Usuarios('arthur', '123456');
//$novo->insert();
//lista = new Usuarios();
//echo json_encode($lista->getList());

//ATUALIZAR USUARIO
$user = new Usuarios();
$user->update(12, 'Chico Xavier', '123456');

$user->loadById(11);
echo $user;



