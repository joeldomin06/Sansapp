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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        <style>
            body{
                background-color: #3F424F;
            }
        </style>
    </head>
    <body>
        <?php include_once '../main/navbar.php'; ?>
        <?php 
        $sentence_perfil = $base->prepare('SELECT * FROM `perfil` WHERE Rol = ?');
        $sentence_perfil->execute(array($_SESSION['Rol']));
        $res_perfil = $sentence_perfil->fetch();
        ?>
        <div class="container">
            <div class="card mt-5 bg-dark text-light">
                <div class="card-body">
                    <h1>
                        <?php echo $res_perfil['Nombre'] ?>
                        <div class="collapse" id="collapsenom">
                            <form action="edit_perfil.php" method="post">
                                <input type="text" name="Nombre" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1\s]{1,30}" placeholder="Nombre usuario" required>
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                            <h6 class="text-danger">Al momento de editar este campo se desconectará de la cuenta, por lo que debe volver a iniciar sesión para ver los cambios realizados</h6>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsenom" role="button" aria-expanded="false" aria-controls="collapsenom"><i class="fa fa-pencil-square"></i></a>
                    </h1>
                    <h3>
                        <?php echo $res_perfil['Rol'] ?>
                    </h3>
                    <h3>
                        <?php echo $res_perfil['Correo'] ?>
                        <div class="collapse" id="collapsecor">
                            <form action="edit_perfil.php" method="post">
                                <input type="text" name="Correo" placeholder="nombre.apellido@usm.cl" pattern="(([a-zA-ZÀ-ÿ\u00f1\u00d1]{1,30}\@gmail\.com|[a-zA-ZÀ-ÿ\u00f1\u00d1\.]{3,33}\@usm\.cl|[a-zA-ZÀ-ÿ\u00f1\u00d1\.]{3,25}\@sansano\.usm\.cl)" required>
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                            <h6 class="text-danger">Al momento de editar este campo se desconectará de la cuenta, por lo que debe volver a iniciar sesión para ver los cambios realizados</h6>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsecor" role="button" aria-expanded="false" aria-controls="collapsecor"><i class="fa fa-pencil-square"></i></a>
                    </h3>
                    <h3>
                        <?php echo $res_perfil['Fecha_nacimiento'] ?> 
                    </h3>
                    <h3>
                        Contraseña
                        <div class="collapse" id="collapsecon">
                            <form action="edit_perfil.php" method="post">
                                <input type="password" name="Contraseña" pattern="[0-9]{1,4}" placeholder="1234" required>
                                <input type="submit" value="Editar" class="btn btn-danger">
                            </form>
                            <h6 class="text-danger">Al momento de editar este campo se desconectará de la cuenta, por lo que debe volver a iniciar sesión para ver los cambios realizados</h6>
                        </div>
                        <a class="text-white" data-bs-toggle="collapse" href="#collapsecon" role="button" aria-expanded="false" aria-controls="collapsecon"><i class="fa fa-pencil-square"></i></a>
                    </h3>
                </div>
            </div>
            <div class="card card-body bg-dark text-light mt-2">
                <h3>
                    Productos Vendidos: 
                    <?php if($res_perfil['Productos_Vendidos'] == NULL){
                        echo 0;
                    } else{
                        echo $res_perfil['Productos_Vendidos'];
                    }
                    ?>
                </h3>
                <h3>
                    Productos Comprados: 
                    <?php if($res_perfil['Productos_Comprados'] == NULL){
                        echo 0;
                    } else{
                        echo $res_perfil['Productos_Comprados'];
                    }
                    ?>
                </h3>
            </div>
            <div class="card card-body bg-dark mt-2">
                <form action="edit_perfil.php" method="post">
                    <input type="hidden" name="Contraseña" value="a">
                    <input type="submit" class="btn btn-danger" value="Eliminar cuenta">
                </form>
            </div>
        </div>
    </body>
</html>