<?php

include_once '../config.php';

$ID = $_GET['Id_producto'];

$sentence = $base->prepare('INSERT INTO `categoría` (Id_categoría,Nombre) VALUES (?,?)');
$sentence->execute(array(NULL,$_POST['new']));

header("Location:etiquetas_producto.php?Id_producto=$ID");

?>