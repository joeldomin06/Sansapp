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
            <div class="card my-5 bg-dark text-light">
                <div class="card-body">
                    <form action="agregar_producto.php" method="post">
                        <h1>Nombre del Producto</h1>
                        <input type="text" name="Nombre" placeholder="Nombre del producto" pattern="[a-zA-ZÀ-ÿ\u00f1\u00d1\s0-9]{1,30}" required>
                        <h1>Precio del Producto</h1>
                        <input type="text" name="Precio" placeholder="999999" pattern="[0-9]{1,6}" required>
                        <h1>Descripción del Producto</h1>
                        <textarea id="des" cols="100" rows="2" name="Descripción"  maxlength="200" required></textarea>
                        <h1>Cantidad del Producto a poner en STOCK</h1>
                        <input type="text" name="Cantidad_actual" placeholder="999" pattern="[0-9]{1,3}" required>
                        <input type="submit" value="Agregar categorias" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>