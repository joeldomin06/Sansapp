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
        <?php

        include_once '../config.php';

        $id_vendedor = $_SESSION['IdV'];

        $sentence = $base->prepare('SELECT * FROM producto WHERE Id_vendedor = :Id');
        $sentence->bindParam(':Id',$id_vendedor,PDO::PARAM_INT);
        $sentence->execute();
        $res = $sentence->fetchAll();

        ?>
            <div class="d-grid gap-2 mt-5">
                <a href="agregar_productos_perfil.php" class="btn btn-block btn-danger"><h1>+ agregar un producto</h1></a>
            </div>
            <h1 class="text-center text-light display-1">
                Tus productos
            </h1>
            <div class="row row-cols-3">
                <?php foreach($res as $prod): ?>
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
                            <h5 class="card-text"><small class="text-muted">Stock: <?php echo $prod['Cantidad_actual'] ?></small></h5>
                            <p class="card-text"><small class="text-muted">Calificación: <?php echo $prod['Calificación_promedio']; ?></small></p>
                            <a href="edit_productos_perfil.php?ip=<?php echo $prod['Id_producto'] ?>" class="btn btn-secondary">Editar</a>
                            <?php if($prod['Cantidad_actual'] > 0): ?>
                            <form action="edit_producto.php?u=1" method="post" class="my-2">
                                <input type="hidden" name="id_producto" value="<?php echo $prod['Id_producto'] ?>">
                                <input type="hidden" name="Cantidad_actual" value="0">
                                <input type="submit" value="Borrar" class="btn btn-danger">
                            </form>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </body>
</html>