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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body{
                background-color: #3F424F;
            }
        </style>
    </head>
    <body>
    <?php include_once '../main/navbar.php'; ?>
    <?php 

    $Nro_carro = $_SESSION['NC'];

    $sentence = $base->prepare("SELECT * FROM `orden de compra` WHERE Nro_carro = ?");
    $sentence->execute(array($Nro_carro));
    $res = $sentence->fetchAll();

    $Precio_total = 0;
    ?>
        <div class="container mt-5">
            <h1 class="text-center text-light display-1">Tu carrito de Compra</h1>
            <div class="card bg-dark text-light">
                <?php if(!empty($res)): ?>
                <div class="row row-cols-1 mx-2">
                    <?php foreach($res as $ord): ?>
                    <?php
                        $sentence_prod = $base->prepare("SELECT * FROM `producto` WHERE Id_producto = ?");
                        $sentence_prod->execute(array($ord['Id_producto']));
                        $prod = $sentence_prod->fetch();
                        $Precio_total += $ord["Precio_total_producto"];
                    ?>
                    <div class="col">
                        <div class="card bg-secondary text-light my-5" >
                        <div class="card-body">
                            <h1 class="card-title">
                                <?php echo $prod['Nombre']; ?>
                            </h1>
                            <h2 class="card-title">
                                $ <?php echo $ord['Precio_total_producto']; ?>
                            </h2>
                            <h5 class="card-text">
                                <small class="text-light">Cantidad: <?php echo $ord['Cantidad_producto'] ?></small>
                                <div class="collapse" id="collapse<?php echo $ord['Id_producto'] ?>">
                                    <form action="edit_carro.php" method="post">
                                        <input type="number" name="Cantidad" id="venta" class="form-control-input" min="1" max="<?php echo $prod['Cantidad_actual'] + $ord['Cantidad_producto'] ?>" required>
                                        <input type="hidden" value="<?php echo $ord['Precio_total_producto'] ?>" name="Precio">
                                        <input type="hidden" value="<?php echo $ord['Cantidad_producto'] ?>" name="Cproducto">
                                        <input type="hidden" value="<?php echo $ord['Nro_orden'] ?>" name="No">
                                        <input type="submit" value="Editar" class="btn btn-danger">
                                    </form>
                                </div>
                                <a class="text-white" data-bs-toggle="collapse" href="#collapse<?php echo $ord['Id_producto'] ?>" role="button" aria-expanded="false" aria-controls="collapse<?php echo $ord['Id_producto'] ?>"><i class="fa fa-pencil-square"></i></a>
                            </h5>
                            <a href="borrar_carro.php?No=<?php echo $ord['Nro_orden'] ?>" class="btn btn-danger">Eliminar orden de compra <i class="fa fa-trash"></i></a>
                        </div>
                    </div>
                    <?php endforeach ?>
                </div>
                <?php endif ?>
            </div>
        </div>
        <div class="container">
            <h3 class="text-light text-center display-3">
                Precio Total: $<?php echo $Precio_total ?>
            </h3>
            <?php if($Precio_total > 0): ?>
            <form action="comprando.php" class="form-control bg-dark" method="post">
                <div class="row">
                    <label for="Lugar_retiro" class="col-form-label"><h3 class="text-light text-center">Lugar de retiro</h3></label>
                    <div class="col mx-3">
                        <input type="text" id="Lugar_retiro" name="lugar" class="form-control my-3" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1\s0-9]{1,50}" required>
                    </div>
                </div>
                <div class="d-grid mx-3">
                    <input class="btn btn-lg btn-danger ml-2" type="submit" value="Comprar">
                </div>
                <input type="hidden" value="<?php echo $Precio_total ?>" name="Precio">
            </form>
            <?php endif ?>
        </div>
    </body>
</html>