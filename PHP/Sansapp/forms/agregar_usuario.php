<?php

$Rol = $_POST['Rol'];
$Nombre = $_POST['Nombre'];
$Correo = $_POST['Correo'];
$Fecha_nacimiento = $_POST['Fecha_nacimiento'];
$Contraseña = $_POST['Contraseña'];

include_once '../config.php';

$sentence = $base->prepare("SELECT * FROM usuario WHERE Rol = ?");
$sentence->execute(array($Rol));
$res = $sentence->fetch();

if(!isset($res["Rol"])){
    $sql = "INSERT INTO usuario (Rol,Nombre,Correo,Contraseña,Fecha_nacimiento) VALUES (?,?,?,?,?)";
    $sentence_sql = $base->prepare($sql);
    
    if( $sentence_sql->execute(array($Rol,$Nombre,$Correo,$Contraseña,$Fecha_nacimiento)) ){
        echo "Realizado!";
        header("Location:inicio_sesion.php");
    }else{
        echo "Error";
        header("Location:registro");
    }
    
    $sentence_sql = null;
    $base = null;
} else{
    header("Location:registro?a=0");
}


?>