<?php

include_once '../config.php';

$id_producto = $_GET['ip'];

$sentence = $base->prepare("SELECT * FROM `producto` WHERE id_producto = ?");
$sentence->execute(array($id_producto));
$result = $sentence->fetch();

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
        <link rel="stylesheet" href="src/css/scroll.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body{
                background-color: #3F424F;
            }
        </style>
    </head>
    <body>
    <?php include_once '../main/navbar.php'; ?>
        <div class="container mt-5">
            <div class="card my-5 bg-dark text-light">
                <div class="card-body">
                    <h1 class="card-title text-center">Comprando producto...</h1>
                    <h2 class="card-title">Producto: <?php echo $result['Nombre'] ?></h2>
                    <h4 class="card-title">Precio: $<?php echo $result['Precio']?></h4>
                    <h4 class="card-title">Stock Actual: <?php echo $result['Cantidad_actual']?></h4>
                    <form action="factura.php" method="post">
                        <label for="venta"><h4>Cantidad a comprar:</h4></label>
                        <input type="number" name="Cantidad_vender" id="venta" class="form-control-input" min="1" max="<?php echo $result['Cantidad_actual'] ?>" required>
                        <input type="hidden" value="<?php echo $result['Precio'] ?>" name="Precio">
                        <input type="hidden" value="<?php echo $result['Id_producto'] ?>" name="ID">
                        <div class="d-grid mt-2">
                            <input type="submit" value="Añadir al carro" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</hmtl>