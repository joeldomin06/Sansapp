<?php

session_start();
include_once '../config.php';

$Nro = $_SESSION["NC"];
$id_comprador = $_SESSION['IdC'];

$lugar = $_POST["lugar"];
$Precio = $_POST["Precio"];

$sentence = $base->prepare("UPDATE `carro de compra` SET Lugar_retiro = ?, Precio_total_compra = ?, Fecha = NOW() WHERE Nro_carro = ?");
$sentence->execute(array($lugar,$Precio,$Nro));

$sentence_carrito = $base->prepare("INSERT INTO `carro de compra` (Nro_carro,Id_comprador,Precio_total_compra,Lugar_retiro,Fecha) Values (?,?,?,?,NOW())");
$sentence_carrito->execute(array(NULL,$id_comprador,0,"Por confirmar"));

$sentence_nrcarrito = $base->prepare("SELECT Nro_carro FROM `carro de compra` WHERE Id_comprador = ? AND Precio_total_compra = ? AND Lugar_retiro = ? AND Fecha = NOW()");
$sentence_nrcarrito->execute(array($id_comprador,0,"Por confirmar"));
$nr = $sentence_nrcarrito->fetch();

$_SESSION["NC"] = $nr['Nro_carro'];

header("Location:../main/main.php");
?>