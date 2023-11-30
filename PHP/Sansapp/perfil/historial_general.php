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
            $sentence_hiv = $base->prepare("SELECT * FROM `historial_ventas` WHERE Rol = ? AND Nombre = ?");
            $sentence_hiv->execute(array($_SESSION['Rol'],$_SESSION['User']));
            $res_hiv = $sentence_hiv->fetchALL();
            $cant_h = count($res_hiv);
            $n_col_h = 7;
            $filas_h = $cant_h/$n_col_h;
            $filas_h = ceil($filas_h);
        ?>
        <div class="container">
            <h1 class="text-center text-light display-1">Productos vendidos</h1>
            <?php if(isset($res_hiv) && $filas_h > 0 ):?>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">
                                #
                            </th>
                            <th scope="col">
                                Producto
                            </th>
                            <th scope="col">
                                Precio de venta
                            </th>
                            <th scope="col">
                                Productos vendidos
                            </th>
                            <th scope="col">
                                Comprador
                            </th>
                            <th scope="col">
                                Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count1 = 1; ?>
                    <?php foreach($res_hiv as $hiv): ?>
                        <tr>
                            <th scope="row"><?php echo $count1 ?></th>
                            <td><?php echo $hiv["Nombre_producto"]; ?></td>
                            <td><?php echo $hiv["Precio_total"]; ?></td>
                            <td><?php echo $hiv["cantidad_producto"]; ?></td>
                            <td><?php echo $hiv["Comprador"]; ?></td>
                            <td><?php echo $hiv["Fecha_venta"]; ?></td>
                        </tr>
                    <?php $count1 += 1; ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h1 class="text text-center text-light">No hay resultados...</h1>
            <?php endif ?>
        </div>
        <?php include_once '../main/navbar.php'; ?>
        <?php 
            $sentence_hic = $base->prepare("SELECT * FROM `historial_compras` WHERE Rol = ? AND Nombre = ?");
            $sentence_hic->execute(array($_SESSION['Rol'],$_SESSION['User']));
            $res_hic = $sentence_hic->fetchALL();
            $cant_hc = count($res_hic);
            $n_col_hc = 7;
            $filas_hc = $cant_hc/$n_col_hc;
            $filas_hc = ceil($filas_hc);
        ?>
        <div class="container">
            <h1 class="text-center text-light display-1">Productos Comprados</h1>
            <?php if(isset($res_hic) && $filas_hc > 0 ):?>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">
                                #
                            </th>
                            <th scope="col">
                                Producto
                            </th>
                            <th scope="col">
                                Precio de venta
                            </th>
                            <th scope="col">
                                Productos vendidos
                            </th>
                            <th scope="col">
                                Vendedor
                            </th>
                            <th scope="col">
                                Fecha
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $count2 = 1; ?>
                    <?php foreach($res_hic as $hic): ?>
                        <tr>
                            <th scope="row"><?php echo $count2 ?></th>
                            <td><?php echo $hic["Nombre_producto"]; ?></td>
                            <td><?php echo $hic["Precio_total"]; ?></td>
                            <td><?php echo $hic["cantidad_producto"]; ?></td>
                            <td><?php echo $hic["Vendedor"]; ?></td>
                            <td><?php echo $hic["Fecha_compra"]; ?></td>
                        </tr>
                    <?php $count2 += 1; ?>
                    <?php endforeach ?>
                    </tbody>
                </table>
            <?php else: ?>
                <h1 class="text text-center text-light">No hay resultados...</h1>
            <?php endif ?>
        </div>
    </body>
</html>