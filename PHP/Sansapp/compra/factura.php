<?php

include_once '../config.php';
session_start();

$nro_carro = $_SESSION['NC'];

$precio = (int)$_POST['Precio'];
$id_producto = $_POST['ID'];
$cantidad = (int)$_POST['Cantidad_vender'];

$precio_total = $precio * $cantidad;

$sentence = $base->prepare("INSERT INTO `orden de compra` (Nro_orden,Id_producto,Nro_Carro,Cantidad_producto,Precio_total_producto) VALUES (?,?,?,?,?)");
$sentence->execute(array(NULL,$id_producto,$nro_carro,$cantidad,$precio_total));

header("Location:carrito_compra.php");
?>