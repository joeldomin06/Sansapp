<?php

include_once '../config.php';

if(isset($_GET['ip'])){
    $id_producto = $_GET['ip'];
    $sentence = $base->prepare('SELECT * FROM producto WHERE Id_producto = :Id');
    $sentence->bindParam(':Id',$id_producto,PDO::PARAM_INT);
    $sentence->execute();
    $res = $sentence->fetch();

}else{
    header("Location:producto.php");
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
        <link rel="stylesheet" href="../src/css/bootstrap.css">
        <link rel="stylesheet" href="src/css/star.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body{
                background-color: #3F424F;
            }
            .checked{
                color: orange;
            }
        </style>
    </head>
    <body>
        <?php include_once '../main/navbar.php'; ?>

        <div class="container mt-5">
            <div class="card my-5 bg-dark text-light">
                <img src="src/img/640x360.png" alt="imagen" class="card-img-top">
                <div class="card-body">
                    <h1 class="card-title">
                        <?php echo $res['Nombre'] ?>
                        <div class="collapse" id="collapsenom">
                            <form action="edit_producto.php?u=1" method="post">
                                <input type="text" name="Nombre" placeholder="Nombre del producto" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1\s]{1,30}" required>
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsenom" role="button" aria-expanded="false" aria-controls="collapsenom"><i class="fa fa-pencil-square"></i></a>
                    </h1>
                    <h3> 
                        Precio: $ <?php echo $res['Precio'] ?>
                        <div class="collapse" id="collapsepre">
                            <form action="edit_producto.php?u=1" method="post">
                                <input type="text" name="Precio" placeholder="999999" pattern="[0-9]{1,6}" required>
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                            <h6 class="text-danger">Debe ser un entero mayor a 0 y menor a 999999</h6>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsepre" role="button" aria-expanded="false" aria-controls="collapsepre"><i class="fa fa-pencil-square"></i></a>
                    </h3>
                    <h5>
                        Descripcion: <?php echo $res['Descripción'] ?>
                    </h5>
                    <p class="card-text">
                        <div class="collapse" id="collapsede">
                            <form action="edit_producto.php?u=1" method="post">
                                <textarea id="des" cols="100" rows="2" name="Descripción" maxlength="200" required></textarea>
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsede" role="button" aria-expanded="false" aria-controls="collapsede"><i class="fa fa-pencil-square"></i></a>
                    </p>
                    <h5>
                        Cantidad en STOCK: <?php echo $res['Cantidad_actual'] ?>
                        <div class="collapse" id="collapsest">
                            <form action="edit_producto.php?u=1" method="post">
                                <input type="text" name="Cantidad_actual" placeholder="999" pattern="[0-9]{1,3}" required>
                                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                            <h6 class="text-danger">Debe ser un entero entre 0 y 999</h6>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsest" role="button" aria-expanded="false" aria-controls="collapsest"><i class="fa fa-pencil-square"></i></a>
                    </h5>
                    <h5>
                        Cantidad Vendida: <?php echo $res['Cantidad_vendida'] ?>
                    </h5>
                    <h5>
                        Calificación: <?php echo $res['Calificación_promedio'] ?>
                    </h5>
                    <?php

                        $sentence_et = $base->prepare("SELECT * FROM `producto por categoría` WHERE Id_producto = ?");
                        $sentence_et->execute(array($id_producto));
                        $res_et = $sentence_et->fetchAll();
                    ?>
                    <?php foreach($res_et as $et): ?>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger" disabled><?php echo $et['Categoría'] ?></button>
                        <a href="borrar_etiqueta.php?ip=<?php echo $id_producto ?>&cat=<?php echo $et['Id_categoría'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                    <?php endforeach ?>
                    <div class="d-grid mt-2">
                        <a href="etiquetas_producto.php?Id_producto=<?php echo $id_producto ?>" class="btn btn-primary">agregar categoría</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>