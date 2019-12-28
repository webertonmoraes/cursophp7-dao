<?php
require_once("config.php");

$pokinha = new Usuarios();
$pokinha->loadById(7);
echo $pokinha;

?>