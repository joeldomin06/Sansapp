<?php

//incluyendo la base
include_once '../config.php';

//extraer de la base
$sentence_vendedor = $base->prepare('SELECT * FROM `top 5 vendedores`');
$sentence_vendidos = $base->prepare('SELECT * FROM `top 5 productos vendidos`');
$sentence_calificados = $base->prepare('SELECT * FROM `top 5 productos calificados`');

$sentence_vendedor->execute();
$sentence_vendidos->execute();
$sentence_calificados->execute();

$res_vendedor = $sentence_vendedor->fetchAll();
$res_vendidos = $sentence_vendidos->fetchAll();
$res_calificados = $sentence_calificados->fetchAll();

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
        <?php include_once 'navbar.php'; ?>

        <div class="container">
            <h1 class="text-light text-center">Top 5 productos más vendidos</h1>
            <div class="row my-5">
                <?php foreach($res_vendidos as $prod): ?>
                <div class="col">
                    <div class="card bg-dark text-light h-100">
                        <div class="card-body">
                            <h2 class="card-title text-center">
                                <?php echo $prod['Nombre']; ?>
                            </h2>
                            <h5 class="card-title">
                                <?php echo $prod['Nombre_vendedor']; ?>
                            </h5>
                            <p class="card-text"><small class="text-muted">Cantidad Vendida <?php echo $prod['Cantidad_vendida']; ?></small></p>
                            <?php if($prod['Cantidad_actual'] > 0): ?>
                            <a href="../producto/detalle.php?ip=<?php echo $prod['Id_producto'] ?>" class="btn btn-secondary">Ver Detalles</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="container">
            <h1 class="text-light text-center">Top 5 productos calificados</h1>
            <div class="row my-5">
                <?php foreach($res_calificados as $prod): ?>
                <div class="col">
                    <div class="card bg-dark text-light h-100">
                        <div class="card-body">
                            <h2 class="card-title text-center">
                                <?php echo $prod['Nombre']; ?>
                            </h2>
                            <h5 class="card-title">
                                <?php echo $prod['Nombre_vendedor']; ?>
                            </h5>
                            <p class="card-text"><small class="text-muted">Calificación <?php echo $prod['Calificación_promedio']; ?></small></p>
                            <?php if($prod['Cantidad_actual'] > 0): ?>
                            <a href="../producto/detalle.php?ip=<?php echo $prod['Id_producto'] ?>" class="btn btn-secondary">Ver Detalles</a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="container">
            <h1 class="text-light text-center">Top 5 vendedores</h1>
            <div class="row my-5">
                <?php foreach($res_vendedor as $vend): ?>
                <?php if($vend['Productos_vendidos'] == NULL)continue; ?>
                <div class="col">
                    <div class="card bg-dark text-light h-100">
                         <div class="card-body">
                             <h1 class="card-title text-center">
                                 <?php echo $vend['Nombre']; ?>
                             </h1>
                             <h3 class="card-title text-center">
                                 <?php echo "Productos vendidos: ".$vend['Productos_vendidos']; ?>
                             </h3>
                         </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </body>
</html>