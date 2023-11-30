<?php

include_once '../config.php';
session_start();

$Nro = $_GET["No"];

$sentence = $base->prepare("DELETE FROM `orden de compra` WHERE Nro_Orden = ?");
$sentence->execute(array($Nro));

header("Location:carrito_compra.php");

?>