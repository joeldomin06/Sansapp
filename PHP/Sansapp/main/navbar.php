<?php
    session_start();
    include_once '../config.php';

    $sentence_cat = $base->prepare('SELECT * FROM categoría');
    $sentence_cat->execute();
    $res_cat = $sentence_cat->fetchAll();

    $cant = count($res_cat);

    $n_col = 4;
    $filas = $cant/$n_col;
    $filas = ceil($filas);
    $count = 0;
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../main/main.php">
      <img src="../src/img/logo_sansapp2.png" alt="" width="100px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../producto/producto.php">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Categorias
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Filtro
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <?php if(isset($_GET['categoria'])): ?>
                <li><a class="dropdown-item" href="../producto/producto.php?calificacion=1&categoria=<?php echo $_GET['categoria'];?>">Calificación</a></li>
                <li><a class="dropdown-item" href="../producto/producto.php?precio=1&categoria=<?php echo $_GET['categoria'];?>">Precio Ascendente</a></li>
                <li><a class="dropdown-item" href="../producto/producto.php?precio=0&categoria=<?php echo $_GET['categoria'];?>">Precio Descendente</a></li>
                <?php else: ?>
                <li><a class="dropdown-item" href="../producto/producto.php?calificacion=1">Calificación</a></li>
                <li><a class="dropdown-item" href="../producto/producto.php?precio=1">Precio Ascendente</a></li>
                <li><a class="dropdown-item" href="../producto/producto.php?precio=0">Precio Descendente</a></li>
                <?php endif ?>
          </ul>
        </li>
        <li class="nav-item">
          <form action="../main/busqueda.php" method="POST">
            <div class="input-group">
              <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" name="Busqueda" required>
              <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                <span>Buscar</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><input type="submit" class="dropdown-item" name="Producto" value="Producto"></li>
                <li><input type="submit" class="dropdown-item" name="Vendedor" value="Vendedor"></button></li>
                <li><input type="submit" class="dropdown-item" name="Categoria" value="Categoria"></button></li>
              </ul>
            </div>
          </form>
        </li>
        <?php if(isset($_SESSION['Rol'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="../compra/carrito_compra.php"><img src="../src/img/carrito.png" alt="" width="20px">Carrito de compra</a>
        </li>
        <?php endif ?>
        <li class="nav-item dropdown">
          <?php if(isset($_SESSION['Rol'])): ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../src/img/user.png" alt="" width="20px"> <?php echo $_SESSION['User']; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="../perfil/perfil.php">Mi Usuario</a></li>
                <li><a class="dropdown-item" href="../perfil/historial_general.php">Historial</a></li>
                <li><a class="dropdown-item" href="../producto/productos_perfil.php">Mis productos</a></li>
                <li><a class="dropdown-item" href="../forms/cierre.php">Cerrar Sesión</a></li>
            </ul>
            <?php else: ?>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="../src/img/user.png" alt="" width="20px"> Usuario
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="../forms/inicio_sesion.php">Iniciar Sesion</a></li>
                <li><a class="dropdown-item" href="../forms/registro.php">Registrarse</a></li>
            </ul>
            <?php endif ?>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="collapse" id="collapseExample">
  <div class="card card-body bg-dark">
    <?php
      $sentence_fila = $base->prepare('SELECT * FROM categoría');
      $sentence_fila->execute();

      $res_fila = $sentence_fila->fetchAll();
    ?>
    <div class="row row-cols-4 mt-2 text-center">
      <?php foreach($res_fila as $fila): ?>
      <div class="col">
        <a class="list-group-item" href="../producto/producto.php?categoria=<?php echo $fila['Id_categoría']; ?>"><?php echo $fila['Nombre']; ?></a>
      </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
