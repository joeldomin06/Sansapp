<?php

include_once '../config.php';
session_start();

$Cantidad = $_POST["Cantidad"];
$Cantidad_total = $_POST["Cproducto"];
$Nro = $_POST["No"];
$Precio = $_POST["Precio"];

$C = (int)$Cantidad;
$P = (int)$Precio;
$CT = (int)$Cantidad_total;

$Precio2 = ($C*$P)/$CT;

$sentence = $base->prepare("UPDATE `orden de compra` SET Cantidad_producto = ?, Precio_total_producto = ? WHERE Nro_orden = ?");
$sentence->execute(array($Cantidad,$Precio2,$Nro));

header("Location:carrito_compra.php");
?>