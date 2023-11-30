<?php

session_start();
include_once '../config.php';

$Rol = $_SESSION['Rol'];

if(isset($_POST['Nombre'])){
    $sql = "UPDATE `usuario` SET Nombre = ? WHERE Rol = ?";
    $sentence = $base->prepare($sql);
    $sentence->execute(array($_POST['Nombre'],$Rol));
} elseif(isset($_POST['Correo'])){
    $sql = "UPDATE `usuario` SET Correo = ? WHERE Rol = ?";
    $sentence = $base->prepare($sql);
    $sentence->execute(array($_POST['Correo'],$Rol));
} elseif(isset($_POST['Contraseña'])){
    if($_POST['Contraseña'] == "a"){
        $sql = "UPDATE `usuario` SET Contraseña = ? WHERE Rol = ?";
        $sentence = $base->prepare($sql);
        $sentence->execute(array(NULL,$Rol));
        $id_vendedor = $_SESSION["IdV"];
        $sentence_prod = $base->prepare("UPDATE producto SET Cantidad_actual = 0 WHERE Id_vendedor = ?");
        $sentence_prod->execute(array($id_vendedor));

    }else{
        $sql = "UPDATE `usuario` SET Contraseña = ? WHERE Rol = ?";
        $sentence = $base->prepare($sql);
        $sentence->execute(array($_POST['Contraseña'],$Rol));
    }
} else{
    header("Location:perfil.php");
}
header("Location:../forms/cierre.php");
?>