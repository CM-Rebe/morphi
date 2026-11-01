<?php

require_once __DIR__ . "/../../../funciones.php";

$mesas = consulta("SELECT * FROM mesas ",null) ?? null;

$mesaActual = null;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOZO</title>
    <link rel="shortcut icon" href="assets/img/logo-morphy.jpg" type="image/x-icon">

    <link rel="stylesheet" href="css/global/selector-universal.css">
    <link rel="stylesheet" href="css/pages/mozo/variables.css">
    <link rel="stylesheet" href="css/pages/mozo/layout.css">
    <link rel="stylesheet" href="css/pages/mozo/mesas.css">
    <link rel="stylesheet" href="css/pages/mozo/panel.css">
</head>
<body>

    <main class="contenedor-principal">
        <section class="area-mesas" id="area-mesas">
            <?php if (isset($mesas)) :
                foreach ($mesas as $key => $value) : 
                    if (isset($_GET["mesa"])) {
                        if ($value["mesasID"] == $_GET["mesa"]) {
                            $mesaActual = $value;
                        }
                    }
                    switch ($value["estado"]) {
                        case "1":
                            $clase = "mesa-verde";
                        break;
                        case "2":
                            $clase = "mesa-amarilla";
                        break;
                        case "3":
                            $clase = "mesa-roja";
                        break;
                        default:
                            $clase = "mesa-roja";
                        break;
                    }
             ?>
                <a class="mesa <?php echo $clase ?>" href="index.php?vista=MOZO&mesa=<?php echo $value["mesasID"] ?>"><?php echo $value["mesasID"] ?></a>
            <?php
                endforeach;
            endif;
            ?>
        </section>

        <aside class="panel-datos">
            <header class="panel-header">
                <h2>Datos 
                <?php 
                if (isset($_GET["mesa"])) {
                    echo " de la mesa " . $_GET["mesa"];
                } 
                else {
                    echo " MANUAL";
                }
                ?>
            </h2>
            </header>
            <?php if (!isset($_GET["mesa"])) : ?>
            <div class="panel-manual" id="panel-manual">
                <div class="leyenda leyenda-verde">
                    <p>NO HAY NADIE SENTADO NI TAMPOCO HAY PEDIDOS ORDENADOS</p>
                </div>
                <div class="leyenda leyenda-roja">
                    <p>ESTÁN SENTADOS Y YA TIENEN EL PEDIDO Y PUEDEN ORDENAR OTROS</p>
                </div>
            </div>
            <?php else : ?>
            <div class="panel-acciones" id="panel-acciones">
                <?php 
                    if (!isset($mesaActual) || $mesaActual["estado"] == 1) : 
                ?>
                <a href="server/php/mozo/actualizar-mesa.php?mesa=<?php echo $mesaActual["mesasID"] ?>&estado=<?php echo $mesaActual["estado"] ?>" class="btn-accion btn-verde">TOMAR PEDIDO</a>
                <?php else : ?>
                <a href="server/php/mozo/actualizar-mesa.php?mesa=<?php echo $mesaActual["mesasID"] ?>&estado=<?php echo $mesaActual["estado"] ?>" class="btn-accion btn-amarillo">TOMAR OTRO PEDIDO</a>
                <a href="server/php/mozo/actualizar-mesa.php?mesa=<?php echo $mesaActual["mesasID"] ?>&estado=<?php echo $mesaActual["estado"] ?>" class="btn-accion btn-rojo">PAGAR</a>
                <?php endif ?>
                <a href="index.php?vista=MOZO" class="btn-cancelar">Cancelar Selección</a>
                <?php mostar_mensaje() ?>
            </div>
            <?php endif ; ?>
        </aside>
    </main>
</body>
</html>