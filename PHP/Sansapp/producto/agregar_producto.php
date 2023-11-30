<?php
session_start();

include_once '../config.php';

$Nombre = $_POST['Nombre'];
$Precio = $_POST['Precio'];
$Descripcion = $_POST['Descripción'];
$Cantidad_actual = $_POST['Cantidad_actual'];

$Id_vendedor = $_SESSION['IdV'];

$sentence = $base->prepare("INSERT INTO `producto` (Id_producto,Id_vendedor,Nombre,Precio,Cantidad_actual,Cantidad_vendida,Descripción,Cantidad_calificación,Calificación_promedio) Values (?,?,?,?,?,?,?,?,?)");
$sentence->execute(array(NULL,$Id_vendedor,$Nombre,$Precio,$Cantidad_actual,0,$Descripcion,0,0));

$getid = $base->prepare("SELECT * FROM `producto` WHERE Id_vendedor = ? AND Nombre = ? AND Precio = ? AND Cantidad_actual = ? AND Cantidad_vendida = ? AND Descripción = ? AND Cantidad_calificación = ? AND Calificación_promedio = ?");
$getid->execute(array($Id_vendedor,$Nombre,$Precio,$Cantidad_actual,0,$Descripcion,0,0));
$res = $getid->fetch();
$ID = $res['Id_producto'];

header("Location:etiquetas_producto.php?Id_producto=$ID");
?>