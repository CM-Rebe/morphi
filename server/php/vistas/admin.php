<?php

require_once __DIR__ . "/../../../funciones.php";

if (!isset($_SESSION["rol"])) {
  header("Location: ../../../index.php?vista=INICIAR_SESION");
  exit();
}

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
  <title>Mi Restaurante</title>

  <link rel="stylesheet" href="../../../css/pages/panel-admin/colores.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/variables.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/reset.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/base.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/utilidades.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/secciones.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/tarjetas.css">
  <link rel="stylesheet" href="../../../css/pages/panel-admin/responsive.css">

</head>

<body>

  <header>
    <h1>Administrador</h1>
    <nav></nav>
    <a href="server/php/iniciar-sesion/cerrar-sesion.php">Cerrar Sesion</a>
  </header>
  <!-- ================= ENTRADAS ================= -->
  <section class="seccion" id="entradas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Entradas</h2>
      <button type="button" onclick="">Agregar</button>
      <div class="linea-decorativa"></div>
      <div class="grid grid-3">
    <?php if (isset($entradas)) :
      foreach ($entradas as $key => $value) :
    ?>
         <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3><?php echo $value["nombre"] ?></h3>
            <img src="../../../assets/img/entradas/<?php echo $value["imagen"] ?>" alt="<?php echo $value["nombre"] ?>">
            <p><?php echo $value["descripcion"] ?></p>
            <button type="button" onclick="">Editar</button>
            <button type="button" onclick="">Eliminar</button>
          </div>
        </article>
    <?php endforeach;
          endif;
    ?>
      </div>
    </div>
  </section>

  <!-- ================= COMIDAS ================= -->
  <section class="seccion seccion-alt" id="comidas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Comidas</h2>
      <div class="linea-decorativa"></div>

      <div class="grid grid-3">
        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Pizza Margherita</h3>
            <img src="../../../assets/img/platos_principales/margarita pizza.webp">
            <p>Salsa de tomate, mozzarella y albahaca fresca.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Lasagna alla Bolognese</h3>
            <img src="assets/img/platos_principales/lasagnea italiana.jpg">
            <p>Capas de pasta, ragú de carne, bechamel y queso gratinado.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Risotto alla Milanese</h3>
            <img src="assets/img/platos_principales/risotto.jpg">
            <p>Arroz cremoso con azafrán, manteca y parmesano.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Penne all'Arrabbiata</h3>
            <img src="assets/img/platos_principales/penne fideos.jpeg">
            <p>Penne con salsa de tomate picante, ajo y perejil.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Ravioli de Ricota y Espinaca</h3>
            <img src="assets/img/platos_principales/ravioles de espinaca.jpg">
            <p>Pasta rellena de ricota y espinaca con salsa de manteca y salvia.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Fettuccine Alfredo</h3>
            <img src="assets/img/platos_principales/fetuchini.jpg">
            <p>Fettuccine con crema, manteca y parmesano.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Osso Buco alla Milanese</h3>
            <img src="assets/img/platos_principales/osobuco.jpg">
            <p>Jarrete de ternera estofado con verduras y vino blanco.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Pollo alla Parmigiana</h3>
            <img src="assets/img/platos_principales/milanesas.avif">
            <p>Pechuga empanada con salsa de tomate y mozzarella gratinada.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ================= BEBIDAS ================= -->
  <section class="seccion" id="bebidas">
    <div class="contenedor">
      <h2 class="titulo-seccion">Bebidas</h2>
      <div class="linea-decorativa"></div>

      <h3 class="texto-centro">Sin alcohol</h3>
      <div class="grid grid-3" style="margin: var(--espacio-md) 0 var(--espacio-lg);">
        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Coca-Cola</h3>
            <img src="assets/img/bebidas/cocacola.jpeg">
            <p>Gaseosa de cola.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Sprite</h3>
            <img src="assets/img/bebidas/sprite.jpg">
            <p>Gaseosa de lima-limón.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Fanta</h3>
            <img src="assets/img/bebidas/fanta.jpeg">
            <p>Gaseosa de naranja.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Agua</h3>
            <img src="assets/img/bebidas/agua.jpeg">
            <p>agua sin gas y con gas.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>limonada</h3>
            <img src="assets/img/bebidas/limonada.avif">
            <p>jugo sabor limon con jengibre y menta.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Caffè Espresso</h3>
            <img src="assets/img/bebidas/cafe espreso.jpg">
            <p>Café italiano corto e intenso.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Cappuccino</h3>
            <img src="assets/img/bebidas/capuccino.jpeg">
            <p>Espresso con leche vaporizada y espuma.</p>
          </div>
        </article>
      </div>

      <h3 class="texto-centro">Con alcohol</h3>
      <div class="grid grid-3" style="margin-top: var(--espacio-md);">
        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Aperol Spritz</h3>
            <img src="assets/img/bebidas/aperol.jpeg">
            <p>Aperol, prosecco y soda con rodaja de naranja.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Bellini</h3>
            <img src="assets/img/bebidas/bellini.jpeg">
            <p>Prosecco con puré de durazno.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Campari</h3>
            <img src="assets/img/bebidas/campari.jpeg">
            <p>Aperitivo amargo de color rojo intenso.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Amaretto</h3>
            <img src="assets/img/bebidas/amaretto.webp">
            <p>Licor dulce de almendras.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Chianti</h3>
            <img src="assets/img/bebidas/chianti{.webp">
            <p>Vino tinto de la Toscana.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- ================= POSTRES ================= -->
  <section class="seccion seccion-alt" id="postres">
    <div class="contenedor">
      <h2 class="titulo-seccion">Postres</h2>
      <div class="linea-decorativa"></div>

      <div class="grid grid-3">
        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Tiramisù</h3>
            <img src="assets/img/postres/tiramisu.jpeg">
            <p>Vainillas con café, crema de mascarpone y cacao.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Panna Cotta</h3>
            <img src="assets/img/postres/panna cotta.webp">
            <p>Crema cocida de leche y vainilla con salsa de frutos rojos.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Cannoli Siciliani</h3>
            <img src="assets/img/postres/cannolini.jpg">
            <p>Tubos de masa crocante rellenos de crema de ricota.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Gelato</h3>
            <img src="assets/img/postres/gelato.jpeg">
            <p>Helado artesanal italiano en distintos sabores.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Affogato</h3>
            <img src="assets/img/postres/affogato.jpeg">
            <p>Helado de vainilla con un espresso caliente por encima.</p>
          </div>
        </article>

        <article class="tarjeta">
          <div class="tarjeta-cuerpo">
            <h3>Zabaglione</h3>
            <img src="assets/img/postres/zabaglione.jpeg">
            <p>Crema tibia de yemas, azúcar y vino Marsala.</p>
          </div>
        </article>
      </div>
    </div>
  </section>

</body>

</html>