<?php

//incluyendo la base
include_once '../config.php';
if(!isset($_GET['categoria'])){
    if(isset($_GET['calificacion'])){
        $sentence_prod = $base->prepare('SELECT * FROM producto WHERE Cantidad_actual > 0 ORDER BY Calificación_promedio DESC');
    }elseif(isset($_GET['precio']) && $_GET['precio'] == 1){
        $sentence_prod = $base->prepare('SELECT * FROM producto WHERE Cantidad_actual > 0 ORDER BY precio ASC');
    }elseif(isset($_GET['precio']) && $_GET['precio'] == 0){
        $sentence_prod = $base->prepare('SELECT * FROM producto WHERE Cantidad_actual > 0 ORDER BY precio DESC');
    }else{
        $sentence_prod = $base->prepare('SELECT * FROM producto WHERE Cantidad_actual > 0');
    }
} else{
    if(isset($_GET['calificacion'])){
        $sentence_prod = $base->prepare('SELECT * FROM `producto por categoría` WHERE Id_categoría = :Id AND Cantidad_actual > 0 ORDER BY Calificación_promedio DESC');
    }elseif(isset($_GET['precio']) && $_GET['precio'] == 1){
        $sentence_prod = $base->prepare('SELECT * FROM `producto por categoría` WHERE Id_categoría = :Id AND Cantidad_actual > 0 ORDER BY precio ASC');
    }elseif(isset($_GET['precio']) && $_GET['precio'] == 0){
        $sentence_prod = $base->prepare('SELECT * FROM `producto por categoría` WHERE Id_categoría = :Id AND Cantidad_actual > 0 ORDER BY precio DESC');
    }else{
        $sentence_prod = $base->prepare('SELECT * FROM `producto por categoría` WHERE Id_categoría = :Id AND Cantidad_actual > 0');
    }
    $sentence_prod->bindParam(':Id',$_GET['categoria'],PDO::PARAM_INT);

    $sentence_cac = $base->prepare('SELECT * FROM categoría WHERE Id_categoría = :Id');
    $sentence_cac->bindParam(':Id',$_GET['categoria'],PDO::PARAM_INT);
    $sentence_cac->execute();
    $res_cac = $sentence_cac->fetch();
}
$sentence_prod->execute();
$res_prod = $sentence_prod->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="../src/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src='../src/js/bootstrap.min.js'></script>
        <link rel="stylesheet" href="../src/css/bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
        <style>
            body{
                background-color: #3F424F;
            }
        </style>
    </head>
    <body>
        <?php include_once '../main/navbar.php'; ?>
        <div class="container">
            <h1 class="text-center text-light display-1">
                <?php 
                    if(!isset($_GET['categoria'])){
                        echo 'Productos';
                    } else{
                        echo $res_cac['Nombre'];
                    }
                ?>
            </h1>
            <div class="row row-cols-3">
                <?php foreach($res_prod as $prod): ?>
                    <div class="col">
                        <div class="card bg-dark text-light my-5" >
                            <img src="src/img/640x360.png" alt="" class="card-img-top">
                            <div class="card-body">
                                <h1 class="card-title">
                                    <?php echo $prod['Nombre']; ?>
                                </h1>
                                <h2 class="card-title">
                                    $ <?php echo $prod['Precio']; ?>
                                </h2>
                                <h5 class="card-text"><small class="text-muted">Stock: <?php echo $prod['Cantidad_actual'] ?></small></h5>
                                <p class="card-text"><small class="text-muted">Calificación: <?php echo $prod['Calificación_promedio']; ?></small></p>
                                <a href="detalle.php?ip=<?php echo $prod['Id_producto'] ?>" class="btn btn-secondary">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </body>
</html>