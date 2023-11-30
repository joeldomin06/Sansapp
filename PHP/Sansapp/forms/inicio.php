<?php

session_start();

include_once '../config.php';

$Rol = $_POST['Rol'];
$Contraseña = $_POST['Contraseña'];

$sql = 'SELECT * FROM usuario WHERE Rol = ?';
$sentence = $base->prepare($sql);
$sentence->execute(array($Rol));
$result = $sentence->fetch();

$sql_com = 'SELECT * FROM comprador WHERE Rol = ?';
$sentence_com = $base->prepare($sql_com);
$sentence_com->execute(array($Rol));
$result_com = $sentence_com->fetch();

$sql_vend = 'SELECT * FROM vendedor WHERE Rol = ?';
$sentence_vend = $base->prepare($sql_vend);
$sentence_vend->execute(array($Rol));
$result_vend = $sentence_vend->fetch();



if(!$result){
    header("Location:inicio_sesion.php?a=0");
} else{
    if($Contraseña == $result['Contraseña']){
        $id_comprador = $result_com['Id_comprador'];
        $_SESSION['Rol'] = $Rol;
        $_SESSION['User'] = $result['Nombre'];
        $_SESSION['IdC'] = $result_com['Id_comprador'];
        $_SESSION['IdV'] = $result_vend['Id_vendedor'];

        $sentence_carrito = $base->prepare("INSERT INTO `carro de compra` (Nro_carro,Id_comprador,Precio_total_compra,Lugar_retiro,Fecha) Values (?,?,?,?,NOW())");
        $sentence_carrito->execute(array(NULL,$id_comprador,0,"Por confirmar"));

        $sentence_nrcarrito = $base->prepare("SELECT Nro_carro FROM `carro de compra` WHERE Id_comprador = ? AND Precio_total_compra = ? AND Lugar_retiro = ? AND Fecha = NOW()");
        $sentence_nrcarrito->execute(array($id_comprador,0,"Por confirmar"));
        $nr = $sentence_nrcarrito->fetch();

        $nro_carrito = $nr['Nro_carro'];

        $_SESSION['NC'] = $nro_carrito;

        echo "sesion iniciada!";
        header("Location:../main/main.php");
    } else{
        header("Location:inicio_sesion.php?a=1");
    }
}

?>