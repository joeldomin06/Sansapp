<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio sesion</title>
        <!--bootstrap css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            body{
                background: url(src/img/USM.jpg);
            }
            .bg{
                background-image: url(src/img/San-Joaquín.jpg);
                background-position: center center;
                background-repeat: no-repeat;
                background-size: 700px;
            }
        </style>
    </head>
    <body>
        <div class="container w-75 bg-primary mt-5 text-light rounded-2 shadow border border-2">
            <div class="row">
                <div class="col bg"></div>
                <div class="col bg-dark">
                    <div class="d-flex my-3 justify-content-center">
                        <img src="logo_sansapp2.png" alt="" width="300">
                    </div>
                    <h2 class="fw-bold text-center py-2">
                        Bienvenido!
                    </h2>
                    <form action="inicio.php" method="POST">
                    <div class="mb-4">
                            <label for="Rol" class="form-label">Rol USM</label>
                            <input type="text" name="Rol" class="form-control" placeholder="999999999-9" pattern="[0-9]{9}-[0-9]" required>
                        </div>
                        <div class="mb-4">
                            <label for="Contraseña" class="form-label">Contraseña</label>
                            <input type="password" name="Contraseña" class="form-control" placeholder="1234" pattern="[0-9]{1,4}" required>
                        </div>
                        <div class="d-grind">
                            <button type="submit" class="btn btn-secondary">Iniciar Sesión</button>
                        </div>
                        <div class="my-5">
                            <span>No tienes cuenta? <a href="registro.php" class="text-info">registrate!</a></span>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <!--bootstrap js-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <?php
            function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
            }
            if(isset($_GET['a'])){
                $mensaje = $_GET['a'];
                if($mensaje == 0){
                    alert("No existe el Usuario!");
                } else{
                    alert("Las contraseñas no son iguales!");
                }
            }
        ?>
    </body>
</html>