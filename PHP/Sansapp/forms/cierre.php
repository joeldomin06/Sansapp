<?php

session_start();

include_once '../config.php';
$Nro = $_SESSION['NC'];

$sentence_encontrar = $base->prepare("SELECT * FROM `carro de compra` WHERE Nro_carro = ?");
$sentence_encontrar->execute(array($Nro));
$res = $sentence_encontrar->fetch();

$precio_total = $res['Precio_total_compra'];

if($precio_total == 0){

    $sentence = $base->prepare("DELETE FROM `orden de compra` WHERE Nro_carro = ?");
    $sentence->execute(array($Nro));

    $sentence_borrar = $base->prepare("DELETE FROM `carro de compra` WHERE Nro_carro = ?");
    $sentence_borrar->execute(array($Nro));
}

$_SESSION = array();

session_destroy();

header("Location:../main/main.php");

?>