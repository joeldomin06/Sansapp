<?php

    session_start();

    $IdV = $_SESSION['IdV'];
    include_once '../config.php';

    $id_producto = $_POST['id_producto'];
    $update = $_GET['u'];

    //actualiza
    if($update == "1"){
        if(isset($_POST['Nombre'])){
            $Nombre = $_POST["Nombre"];
            $sql_obs = "UPDATE `producto` SET Nombre = ? WHERE Id_producto = ?";
            $sentence_obs = $base->prepare($sql_obs);
            $sentence_obs->execute(array($Nombre,$id_producto));
            header("Location:edit_productos_perfil.php?ip=$id_producto");
        } elseif(isset($_POST['Precio'])){
            $Precio = $_POST["Precio"];
            $sql_obs = "UPDATE `producto` SET Precio = ? WHERE Id_producto = ?";
            $sentence_obs = $base->prepare($sql_obs);
            $sentence_obs->execute(array($Precio,$id_producto));
            header("Location:edit_productos_perfil.php?ip=$id_producto");
        } elseif(isset($_POST['Descripción'])){
            $Descripcion = $_POST['Descripción'];
            $sql_obs = "UPDATE `producto` SET Descripción = ? WHERE Id_producto = ?";
            $sentence_obs = $base->prepare($sql_obs);
            $sentence_obs->execute(array($Descripcion,$id_producto));
            header("Location:edit_productos_perfil.php?ip=$id_producto");
        } elseif(isset($_POST['Cantidad_actual'])){
            $Cantidad = $_POST['Cantidad_actual'];
            $sql_obs = "UPDATE `producto` SET Cantidad_actual = ? WHERE Id_producto = ?";
            $sentence_obs = $base->prepare($sql_obs);
            $sentence_obs->execute(array($Cantidad,$id_producto));
            if($Cantidad == "0"){
                header("Location:productos_perfil.php");
            } else{
                header("Location:edit_productos_perfil.php?ip=$id_producto");
            }
        }
    //insert
    } else{
        $sql_obs = "INSERT INTO `observación` (Nro_observación,Id_producto,Comentario,Fecha_comentario,Id_comprador) VALUES (?,?,?,NOW(),?)";
        $sentence_obs = $base->prepare($sql_obs);
    }
?>