<?php

include_once '../config.php';

$id_producto = $_GET['Id_producto'];

$sentence = $base->prepare("SELECT * FROM `categoría sin producto` WHERE id_producto = ?");
$sentence->execute(array($id_producto));
$result = $sentence->fetchAll();

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
                    <h1>
                        Agregar categoria
                    </h1>
                    <form action="agregar_etiqueta.php?Id_producto=<?php echo $id_producto ?>" method="post">
                    <input type="text" name="new" placeholder="Nombre Etiqueta" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1\s]{1,30}" required>
                        <input type="submit" value="Enviar" class="btn btn-danger">
                    </form>
                    <form action="agregar_etiqueta_producto.php?Id_producto=<?php echo $id_producto ?>" method="post">
                        <ul class="list-group">
                            <?php foreach($result as $cat): ?>
                            <li class="list-group-item bg-dark text-light">
                                <label for="<?php echo $cat['nombre'] ?>" class="form-check-label">
                                    <?php echo $cat['nombre'] ?>
                                </label>
                                <input type="checkbox" name="checklist[]" value="<?php echo $cat['id_categoría'] ?>" id="<?php echo $cat['nombre'] ?>" class="form-check-input">
                            </li>
                            <?php endforeach ?>
                        </ul>
                        <div class="d-grid gap-2">
                            <input type="submit" class="btn btn-danger" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>