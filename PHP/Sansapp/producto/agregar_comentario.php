<?php 
// agregar un caso de que en vez de un insert un update del comentario
session_start();

$id_producto = $_GET['ip'];

$Rol = $_SESSION['Rol'];
$IdC = $_SESSION['IdC'];

include_once '../config.php';

if(isset($_POST['comentario']) && $_POST['comentario'] != ''){

    $comentario = $_POST['comentario'];
    $sql_obs = "INSERT INTO `observación` (Nro_observación,Id_producto,Comentario,Fecha_comentario,Id_comprador) VALUES (?,?,?,NOW(),?)";
    $sentence_obs = $base->prepare($sql_obs);
    $sentence_obs->execute(array(NULL,$id_producto,$comentario,$IdC));
} elseif(isset($_POST['recomentario']) && $_POST['recomentario'] != ''){
    $comentario = $_POST['recomentario'];
    $nro_comentario = $_GET['nrc'];
    $sql_obs = "UPDATE `observación` SET Comentario = ?, Fecha_comentario = NOW() WHERE Nro_observación = :Nro";
    $sentence_obs = $base->prepare($sql_obs);
    $sentence_obs->bindParam(':Nro',$nro_comentario,PDO::PARAM_INT);
    $sentence_obs->execute(array($comentario));
} elseif(isset($_GET['b'])){
    $nro_comentario = $_GET['nrc'];
    $sql_obs = "DELETE FROM `observación` WHERE Nro_observación = :Nro";
    $sentence_obs = $base->prepare($sql_obs);
    $sentence_obs->bindParam(':Nro',$nro_comentario,PDO::PARAM_INT);
    $sentence_obs->execute();
}

if(isset($_POST['cal'])){
    $calificacion = $_POST['cal'];
    $sql_cal = "INSERT INTO `calificación producto` (Id_producto,Id_comprador,Calificación) VALUES (:IDP,:IDC,:CAL)";
    $sentence_cal = $base->prepare($sql_cal);
    $sentence_cal->bindParam(':IDC',$IdC,PDO::PARAM_INT);
    $sentence_cal->bindParam(':IDP',$id_producto,PDO::PARAM_INT);
    $sentence_cal->bindParam(':CAL',$calificacion,PDO::PARAM_INT);
    $sentence_cal->execute();
} elseif(isset($_POST['recal'])){
    $calificacion = $_POST['recal'];
    $sql_cal = "UPDATE `calificación producto` SET Calificación = :CAL WHERE Id_comprador = :IDC AND Id_producto = :IDP";
    $sentence_cal = $base->prepare($sql_cal);
    $sentence_cal->bindParam(':IDC',$IdC,PDO::PARAM_INT);
    $sentence_cal->bindParam(':IDP',$id_producto,PDO::PARAM_INT);
    $sentence_cal->bindParam(':CAL',$calificacion,PDO::PARAM_INT);
    $sentence_cal->execute();
}

?>
<?php header("Location:detalle.php?ip=$id_producto") ?>