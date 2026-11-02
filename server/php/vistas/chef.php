<?php
require_once __DIR__ . "/../../../funciones.php";

$ordenes = ejecutar_consulta_sql("SELECT O.ordenesID,O.mesasID, E.nombre AS entradas, PP.nombre AS platos_principales, B.nombre AS bebidas, P.nombre ,D.especificaciones AS postres FROM ordenes O 
        LEFT JOIN detalle_ordenes D
        ON O.detalle_ordenesID = D.detalle_ordenesID
        LEFT JOIN entradas E
        ON E.entradasID = D.entradasID
        LEFT JOIN platos_principales PP
        ON PP.platos_principalesID = D.platos_principalesID
        LEFT JOIN bebidas B
        ON B.bebidasID = D.bebidasID
        LEFT JOIN postres P
        ON P.postresID = D.postresID
        WHERE estado = 'proceso'
    ", null);
    //LEFT JOIN es para si la tabla de la izquierda (ordenes) tiene algo vacío, lo muestra igual
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEF</title>
    <link rel="shortcut icon" href="assets/img/logo-morphy.jpg" type="image/x-icon">

    <link rel="stylesheet" href="css/pages/chef/chef.css">
</head>

<body>
    
    <a href="server/php/iniciar-sesion/cerrar-sesion.php">Cerrar Sesion</a>
    <main class="contenedor-chef">
        <h1>PEDIDOS</h1>

        <section class="lista-pedidos">
            <?php if (!empty($ordenes)) : ?>
                <?php foreach ($ordenes as $orden) : ?>
                    <?php
                    // Recolectamos los nombres de las comidas que existan en este pedido
                    $comidas = [];
                    if (!empty($orden['entradas'])) { $comidas[] = $orden['entradas']; }
                    if (!empty($orden['platos_principales'])) { $comidas[] = $orden['platos_principales']; }
                    if (!empty($orden['bebidas'])) { $comidas[] = $orden['bebidas']; }
                    if (!empty($orden['postres'])) { $comidas[] = $orden['postres']; }
                    
                    //PARA MOSTRARLO EN UN TEXTO
                    $texto_comida = "";
                    foreach ($comidas as $comidas_valor_foreach) {
                        $texto_comida .= $comidas_valor_foreach;
                    }
                    ?>

                    <article class="tarjeta-pedido">
                        <div class="info-pedido">
                            <h2><?= sacar_caracteres_html($texto_comida) ?></h2>

                            <!-- Mostramos las especificaciones entre paréntesis si las hay -->
                            <?php if (!empty($orden['especificaciones'])) : ?>
                                <span class="especificaciones">(<?= htmlspecialchars($orden['especificaciones']) ?>)</span>
                            <?php endif; ?>
                        </div>

                        <!-- Botón LISTO que envía el ID de la orden -->
                        <a href="server/php/chef/terminar-pedido.php?id=<?= $orden['ordenesID'] ?>" class="btn-listo">LISTO</a>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="sin-pedidos">No hay pedidos pendientes por preparar.</p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>