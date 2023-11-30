<?php

include_once '../config.php';

$busqueda = $_POST['Busqueda'];
$expresion = '%'.$busqueda.'%';

if(isset($_POST['Producto'])){
    $sentence_prod = $base->prepare('SELECT * FROM `producto` WHERE Nombre LIKE ? AND Cantidad_actual > 0');
    $sentence_prod->execute(array($expresion));
    $res_prod = $sentence_prod->fetchAll();

    $cont = count($res_prod);
} elseif(isset($_POST['Vendedor'])){
    $sentence_us = $base->prepare('SELECT * FROM `perfil` WHERE Nombre LIKE ? AND Contraseña IS NOT NULL');
    $sentence_us->execute(array($expresion));
    $res_us = $sentence_us->fetchAll();

    $cont = count($res_us);
} elseif(isset($_POST['Categoria'])){
    $sentence_cat = $base->prepare('SELECT * FROM `categoría` WHERE Nombre LIKE ?');
    $sentence_cat->execute(array($expresion));
    $res_cate = $sentence_cat->fetchAll();

    $cont = count($res_cate);
}

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

        <?php if(isset($busqueda)): ?>
        <div class="container">
            <h1 class="text-center text-light display-3">
                <?php echo $cont ?> Resultados encontrados con la busqueda: <?php echo $busqueda ?>
            </h1>
            <div class="row row-cols-2">
                <?php if(isset($_POST['Producto']) && $cont > 0): ?>
                    <?php foreach($res_prod as $prod): ?>
                        <div class="col">
                            <div class="card bg-dark text-light my-5">
                                <img src="src/img/640x360.png" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php echo $prod['Nombre']; ?>
                                    </h1>
                                    <h2 class="card-title">
                                        $ <?php echo $prod['Precio']; ?>
                                    </h2>
                                    <h5>Descripción</h5>
                                    <p><?php echo $prod['Descripción'] ?></p>
                                    <h5 class="card-text"><small class="text-muted">Stock: <?php echo $prod['Cantidad_actual'] ?></small></h5>
                                    <p class="card-text"><small class="text-muted">Calificación: <?php echo $prod['Calificación_promedio']; ?></small></p>
                                    <a href="../producto/detalle.php?ip=<?php echo $prod['Id_producto'] ?>" class="btn btn-secondary">Ver Detalles</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php elseif(isset($_POST['Vendedor'])): ?>
                    <?php foreach($res_us as $us): ?>
                        <div class="col">
                            <div class="card bg-dark text-light my-5">
                                <div class="card-body">
                                    <h1 class="card-title">
                                        <?php echo $us['Nombre']; ?>
                                    </h1>
                                    <h2 class="card-title">
                                        <?php echo $us['Correo']; ?>
                                    </h2>
                                    <p class="card-text">
                                        <small class="text-muted">
                                            Cantidad vendida: 
                                            <?php if($us['Productos_Vendidos'] == NULL){
                                                echo 0;
                                                } else{
                                                echo $us['Productos_Vendidos'];
                                                }
                                            ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php elseif(isset($_POST['Categoria'])): ?>
                    <?php foreach($res_cate as $cate): ?>
                        <div class="col">
                            <a class="card bg-dark text-light my-5 list-group-item" href="../producto/producto.php?categoria=<?php echo $cate['Id_categoría']; ?>">
                                <div class="card-body text-center">
                                    <h1 class="card-title">
                                        <?php echo $cate['Nombre']; ?>
                                    </h1>
                                </div>
                            </a>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
        <?php else: ?>
        <div class="container">
            <h1 class="text-center text-light display-1">
                No deberias estar aqui >:|
            </h1>
            <?php header("Location:main.php") ?>
        </div>
        <?php endif ?>
    </body>
</html>