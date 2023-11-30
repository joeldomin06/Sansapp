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
                    </h1>
                    <h3> Precio: $ <?php echo $res['Precio'] ?></h3>
                    <h5>
                        Descripcion
                    </h5>
                    <p class="card-text">
                        <?php echo $res['Descripción'] ?>
                    </p>
                    <h5>
                        Calificación: <?php echo $res['Calificación_promedio'] ?>
                    </h5>
                    <?php if(isset($_SESSION['IdC'])): ?>
                    <a href="../compra/compra_producto.php?ip=<?php echo $_GET['ip'] ?>" class="btn btn-block btn-secondary"><img src="../src/img/carrito.png" alt="" width="15px">Añadir al carro de compra</a>
                    <?php endif ?>
                </div>
            </div>
            <?php if(isset($_SESSION['IdC'])): ?>
                <div class="card mb-5 bg-dark text-light">
                    <div class="container mb-2">
                        <?php $id_comprador = $_SESSION['IdC']; ?>
                        <form action="agregar_comentario.php?ip=<?php echo $id_producto ?>" class="form-control mt-2 bg-dark text-light" method="POST">
                            <?php 

                                $sentence_cals = $base->prepare("SELECT * FROM `calificación producto` WHERE Id_comprador = :IdC AND Id_producto = :IdP");
                                $sentence_cals->bindParam(':IdC',$id_comprador,PDO::PARAM_INT);
                                $sentence_cals->bindParam(':IdP',$id_producto,PDO::PARAM_INT);
                                $sentence_cals->execute();
                                $res_cals = $sentence_cals->fetch();
                            ?>
                            <?php if($res_cals): ?>
                                <h1 class="card-title">Calificación previa</h1>
                                <div class="d-flex justify-content-center">
                                    <div class="star-cont">
                                        <?php for($i=0;$i<$res_cals["Calificación"];$i = $i + 1): ?>
                                            <i class="fa fa-star rating checked"></i>
                                        <?php endfor ?>
                                        <?php for($i=$res_cals["Calificación"];$i<5;$i = $i + 1): ?>
                                            <i class="fa fa-star rating "></i>
                                        <?php endfor ?>
                                    </div>
                                </div>
                                <h1 class="card-title">Re-califica el producto</h1>
                                <div class="d-flex justify-content-center">
                                    <div class="star-cont">
                                        <input type="radio" name="recal" id="cal-5" value="5">
                                        <label for="cal-5" class="fa fa-star"></label>
                                        <input type="radio" name="recal" id="cal-4" value="4">
                                        <label for="cal-4" class="fa fa-star"></label>
                                        <input type="radio" name="recal" id="cal-3" value="3">
                                        <label for="cal-3" class="fa fa-star"></label>
                                        <input type="radio" name="recal" id="cal-2" value="2">
                                        <label for="cal-2" class="fa fa-star"></label>
                                        <input type="radio" name="recal" id="cal-1" value="1">
                                        <label for="cal-1" class="fa fa-star"></label>
                                    </div>
                                </div>
                            <?php else: ?>
                                <h1 class="card-title">Califica el producto</h1>
                                <div class="d-flex justify-content-center">
                                    <div class="star-cont">
                                        <input type="radio" name="cal" id="cal-5" value="5">
                                        <label for="cal-5" class="fa fa-star"></label>
                                        <input type="radio" name="cal" id="cal-4" value="4">
                                        <label for="cal-4" class="fa fa-star"></label>
                                        <input type="radio" name="cal" id="cal-3" value="3">
                                        <label for="cal-3" class="fa fa-star"></label>
                                        <input type="radio" name="cal" id="cal-2" value="2">
                                        <label for="cal-2" class="fa fa-star"></label>
                                        <input type="radio" name="cal" id="cal-1" value="1">
                                        <label for="cal-1" class="fa fa-star"></label>
                                    </div>
                                </div>
                            <?php endif ?>
                            
                            <h3>Agregar comentario</h3>
                            <div class="container ">
                                <textarea name="comentario" id="com" cols="125" rows="4" maxlength="500"></textarea>
                            </div>
                            <input type="submit" class="btn btn-secondary" value="Enviar">
                        </form>
                        <h1>Tus Comentarios</h1>
                        <?php 
                            $sentence_obss = $base->prepare("SELECT * FROM `observación` WHERE Id_comprador = :IdC AND Id_producto = :IdP ORDER BY Fecha_comentario DESC");
                            $sentence_obss->bindParam(':IdC',$id_comprador,PDO::PARAM_INT);
                            $sentence_obss->bindParam(':IdP',$id_producto,PDO::PARAM_INT);
                            $sentence_obss->execute();
                            $res_obss = $sentence_obss->fetchAll();
                        ?>
                            <?php if($res_obss): ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach($res_obss as $obs): ?>
                                <li class="list-group-item bg-dark text-light">
                                    <h5><?php echo $obs['Fecha_comentario'] ?></h5>
                                    <p><?php echo $obs['Comentario'] ?></p>
                                    <a href="edit_comentario.php?nrc=<?php echo $obs['Nro_observación']?>" class="btn btn-secondary">Editar</a>
                                    <a href="agregar_comentario.php?nrc=<?php echo $obs['Nro_observación']?>&b=1&ip=<?php echo $id_producto ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            <?php endif ?>
                    </div>
                </div>
            <?php endif ?>
            <div class="card mb-5 bg-dark text-light">
                <div class="container">
                    <h1 class="card-title">Otros Comentarios</h1>
                    <?php
                        if(!isset($_SESSION["IdC"])){
                            $id_comprador = 0;
                        }
                        $sentence_obs = $base->prepare("SELECT * FROM `observación` WHERE Id_comprador != :IdC AND Id_producto = :IdP ORDER BY Fecha_comentario DESC");
                        $sentence_obs->bindParam(':IdC',$id_comprador,PDO::PARAM_INT);
                        $sentence_obs->bindParam(':IdP',$id_producto,PDO::PARAM_INT);
                        $sentence_obs->execute();
                        $res_ob = $sentence_obs->fetchAll();
                    ?>
                    <?php if($res_ob): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach($res_ob as $obs): ?>
                        <li class="list-group-item bg-dark text-light">
                            <h6><?php echo $obs['Fecha_comentario'] ?></h6>
                            <p><?php echo $obs['Comentario'] ?></p>
                        </li>
                        <?php endforeach ?>
                    </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </body>
</html>