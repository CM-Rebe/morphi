<?php

require_once __DIR__ . "/../../../funciones.php";

$entradas = consulta("SELECT * FROM entradas",null);
$platos_principales = consulta("SELECT * FROM platos_principales",null);
$postres = consulta("SELECT * FROM postres",null);
$bebidas = consulta("SELECT * FROM bebidas",null);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN</title>

  <link rel="shortcut icon" href="assets/img/logo-morphy.jpg" type="image/x-icon">

  <link rel="stylesheet" href="css/global/selector-universal.css">
  <link rel="stylesheet" href="css/pages/admin/colores.css">
  <link rel="stylesheet" href="css/pages/admin/variables.css">
  <link rel="stylesheet" href="css/pages/admin/header.css">
  <link rel="stylesheet" href="css/pages/admin/base.css">
  <link rel="stylesheet" href="css/pages/admin/botones.css">
  <link rel="stylesheet" href="css/pages/admin/utilidades.css">
  <link rel="stylesheet" href="css/pages/admin/secciones.css">
  <link rel="stylesheet" href="css/pages/admin/tarjetas.css">
  <link rel="stylesheet" href="css/pages/admin/responsive.css">

</head>

<body>

  <header>
    <h1>Administrador</h1>
    <nav>
      <a href="#entradas">Entradas</a>
      <a href="#comidas">Platos Principales</a>
      <a href="#bebidas">Bebidas</a>
      <a href="#postres">Postres</a>
    </nav>
    <a href="server/php/iniciar-sesion/cerrar-sesion.php">Cerrar Sesion</a>
  </header>
  <!-- ================= ENTRADAS ================= -->
  <section class="seccion" id="entradas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Entradas</h2>
      <div class="acciones-tarjeta">
        <a href="#" class="btn btn-editar">Agregar</a>
      </div>
      <div class="linea-decorativa"></div>
      <div class="grid grid-3">
        <?php if (isset($entradas)) :
          foreach ($entradas as $key => $value) :
        ?>
            <article class="tarjeta">
              <div class="tarjeta-cuerpo">
                <h3><?php echo $value["nombre"] ?></h3>
                <img src="assets/img/entradas/<?php echo $value["imagen"] ?>" alt="<?php echo $value["nombre"] ?>">
                <p><?php echo $value["descripcion"] ?></p>
                <h3>Cantidad: <?php echo $value["cantidad"] ?></h3>
                <div class="acciones-tarjeta">
                  <a href="#" class="btn btn-editar">Editar</a>
                  <a href="#" class="btn btn-eliminar">Eliminar</a>
                </div>
              </div>
            </article>
        <?php endforeach;
              endif;
        ?>
      </div>
    </div>
  </section>

  <!-- ================= PLATOS PRINCIPALES ================= -->
  <section class="seccion seccion-alt" id="comidas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Comidas</h2>
      <div class="acciones-tarjeta">
        <a href="#" class="btn btn-editar">Agregar</a>
      </div>
      <div class="linea-decorativa"></div>
      <div class="grid grid-3">
        <?php if (isset($platos_principales)) :
          foreach ($platos_principales as $key => $value) :
        ?>
            <article class="tarjeta">
              <div class="tarjeta-cuerpo">
                <h3><?php echo $value["nombre"] ?></h3>
                <img src="assets/img/platos_principales/<?php echo $value["imagen"] ?>" alt="<?php echo $value["nombre"] ?>">
                <p><?php echo $value["descripcion"] ?></p>
                <h3>Cantidad: <?php echo $value["cantidad"] ?></h3>
                <div class="acciones-tarjeta">
                  <a href="#" class="btn btn-editar">Editar</a>
                  <a href="#" class="btn btn-eliminar">Eliminar</a>
                </div>
              </div>
            </article>
        <?php endforeach;
              endif;
        ?>
      </div>
    </div>
  </section>

  <!-- ================= BEBIDAS ================= -->
  <section class="seccion" id="bebidas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Bebidas</h2>
      <div class="acciones-tarjeta">
        <a href="#" class="btn btn-editar">Agregar</a>
      </div>
      <div class="linea-decorativa"></div>
      <div class="grid grid-3">
        <?php if (isset($bebidas)) :
          foreach ($bebidas as $key => $value) :
        ?>
            <article class="tarjeta">
              <div class="tarjeta-cuerpo">
                <h3><?php echo $value["nombre"] ?></h3>
                <img src="assets/img/bebidas/<?php echo $value["imagen"] ?>" alt="<?php echo $value["nombre"] ?>">
                <p><?php echo $value["descripcion"] ?></p>
                <h3>Cantidad: <?php echo $value["cantidad"] ?></h3>
                <div class="acciones-tarjeta">
                  <a href="#" class="btn btn-editar">Editar</a>
                  <a href="#" class="btn btn-eliminar">Eliminar</a>
                </div>
              </div>
            </article>
        <?php endforeach;
              endif;
        ?>
      </div>
    </div>
  </section>

  <!-- ================= POSTRES ================= -->
  <section class="seccion seccion-alt" id="postres">
    <div class="contenedor">
      <h2 class="titulo-seccion">Postres</h2>
      <div class="acciones-tarjeta">
        <a href="#" class="btn btn-editar">Agregar</a>
      </div>
      <div class="linea-decorativa"></div>
      <div class="grid grid-3">
        <?php if (isset($postres)) :
          foreach ($postres as $key => $value) :
        ?>
            <article class="tarjeta">
              <div class="tarjeta-cuerpo">
                <h3><?php echo $value["nombre"] ?></h3>
                <img src="assets/img/postres/<?php echo $value["imagen"] ?>" alt="<?php echo $value["nombre"] ?>">
                <p><?php echo $value["descripcion"] ?></p>
                <h3>Cantidad: <?php echo $value["cantidad"] ?></h3>
                <div class="acciones-tarjeta">
                  <a href="#" class="btn btn-editar">Editar</a>
                  <a href="#" class="btn btn-eliminar">Eliminar</a>
                </div>
              </div>
            </article>
        <?php endforeach;
              endif;
        ?>
      </div>
    </div>
  </section>

</body>

</html>