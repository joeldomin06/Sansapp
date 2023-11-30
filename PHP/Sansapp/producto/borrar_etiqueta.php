<?php

include_once '../config.php';

$id_producto = $_GET['ip'];
$categoria = $_GET['cat'];

$sentence = $base->prepare("DELETE FROM `etiqueta producto` WHERE Id_producto = :Id AND Id_categoría = :Id2");
$sentence->bindParam(':Id',$id_producto,PDO::PARAM_INT);
$sentence->bindParam(':Id2',$categoria,PDO::PARAM_INT);
$sentence->execute();

header("Location:edit_productos_perfil.php?ip=$id_producto");
?>