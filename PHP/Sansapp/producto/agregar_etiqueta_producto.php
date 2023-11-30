<?php

include_once '../config.php';

$checklist = $_POST['checklist'];

$Id_producto = $_GET['Id_producto'];

if(!empty($checklist)){
    foreach($checklist as $chk){
        echo $chk;
        $sentence_chk = $base->prepare("INSERT INTO `etiqueta producto` (Id_categoría,Id_producto) Values (?,?)");
        $sentence_chk->execute(array($chk,$Id_producto));
    }
}
header('Location:productos_perfil.php');

?>