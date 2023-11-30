<?php

$nro_comentario = $_GET['nrc'];

$sentence_get = $base->prepare('SELECT * FROM observación WHERE Nro_comentario = :NRC');
$sentence_get->bindParam(':NRC',$nro_comentario,PDO::PARAM_INT);
$sentence_get->execute();
$res = $sentence_get->fetch();

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
        <div class="container mt-5">
            <div class="card my-5">
                <h3>Cometario a editar</h3>
                <p><?php echo $res['Comentario'] ?></p>
                <form action="agregar_comentario.php?ip=<?php echo $res['Id_producto']?>&nrc=<?php echo $nro_comentario?>" method="post">
                    <h3>Editar Comentario</h3>
                    <div class="container ">
                        <textarea name="recomentario" id="com" cols="125" rows="4" maxlength="500" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-dark" value="Enviar">
                </form>
            </div>
        </div>
    </body>
</html>