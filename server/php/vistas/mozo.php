<?php

require_once __DIR__ . "/../../../funciones.php";

$mesas = ejecutar_consulta_sql("SELECT * FROM mesas ", null) ?? null;

$entradas = ejecutar_consulta_sql("SELECT * FROM entradas", null) ?? null;
$platos = ejecutar_consulta_sql("SELECT * FROM platos_principales", null) ?? null;
$bebidas = ejecutar_consulta_sql("SELECT * FROM bebidas", null) ?? null;
$postres = ejecutar_consulta_sql("SELECT * FROM postres", null) ?? null;

$mesa_actual = null;

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
    <link rel="stylesheet" href="css/pages/mozo/formulario.css">
    <link rel="stylesheet" href="css/pages/mozo/layout.css">
    <link rel="stylesheet" href="css/pages/mozo/mesas.css">
    <link rel="stylesheet" href="css/pages/mozo/panel.css">
</head>

<body>
    <a href="server/php/iniciar-sesion/cerrar-sesion.php">Cerrar Sesion</a>
    <main class="contenedor-principal">
        <section class="area-mesas" id="area-mesas">
            <!-- FOREACH CON TODAS LAS MESAS + MESA ACTUAL -->
            <?php if (isset($mesas)) :
                foreach ($mesas as $mesa_actual_foreach) :
                    if (isset($_GET["mesa"])) {
                        if ($mesa_actual_foreach["mesasID"] == $_GET["mesa"]) {
                            $mesa_actual = $mesa_actual_foreach;
                        }
                    }
                    switch ($mesa_actual_foreach["estado"]) {
                        case "ocupado":
                            $clase = "mesa-roja";
                            break;
                        default:
                            $clase = "mesa-verde";
                            break;
                    }
            ?>
                    <a class="mesa <?php echo $clase ?>" href="index.php?vista=MOZO&mesa=<?php echo $mesa_actual_foreach["mesasID"] ?>"><?php echo $mesa_actual_foreach["mesasID"] ?></a>
            <?php
                endforeach;
            endif;
            ?>
        </section>

        <aside class="panel-datos">
            <header class="panel-header">
                <!-- SI HAY MESA ACTUAL ES UNA MESA, SINÓ ES EL MANUAL -->
                <h2>Datos
                    <?php
                    if (isset($mesa_actual)) {
                        echo " de la mesa " . $mesa_actual["mesasID"];
                    } else {
                        echo " MANUAL";
                    }
                    ?>
                </h2>
            </header>

            <!-- SELECCIONAR MANUAL O OPCIONES DE UNA MESA -->
            <?php if (!isset($mesa_actual)) : ?>
                <div class="panel-manual" id="panel-manual">
                    <p>Colores:</p>
                    <div class="leyenda leyenda-verde">
                        <p>NO HAY NADIE SENTADO NI TAMPOCO HAY PEDIDOS ORDENADOS</p>
                    </div>
                    <div class="leyenda leyenda-roja">
                        <p>ESTÁN SENTADOS Y YA TIENEN EL PEDIDO Y PUEDEN ORDENAR OTROS</p>
                    </div>
                    <p>Opciones:</p>
                    <div class="leyenda leyenda-amarilla">
                        <p>HAZ CLICK A UNA MESA PARA AGREGARLE UN PEDIDO O COBRARLOS</p>
                    </div>
                </div>
                <?php mostar_mensaje() ?>
            <?php else : ?>
                <div class="panel-acciones" id="panel-acciones">
                    <?php
                    if ($mesa_actual["estado"] == "libre" && !isset($_GET["agregar"])) :
                    ?>
                        <a href="index.php?vista=MOZO&mesa=<?php echo $mesa_actual["mesasID"] ?>&agregar=ordenar_pedido" class="btn-accion btn-verde">TOMAR PEDIDO</a>
                        <a href="index.php?vista=MOZO" class="btn-cancelar">Cancelar Selección</a>
                    <?php elseif (!isset($_GET["agregar"])) : ?>
                        <a href="index.php?vista=MOZO&mesa=<?php echo $mesa_actual["mesasID"] ?>&agregar=ordenar_otro_pedido" class="btn-accion btn-amarillo">TOMAR OTRO PEDIDO</a>
                        <a href="index.php?vista=MOZO&mesa=<?php echo $mesa_actual["mesasID"] ?>&agregar=pagar" class="btn-accion btn-rojo">PAGAR</a>
                        <a href="index.php?vista=MOZO" class="btn-cancelar">Cancelar Selección</a>
                    <?php endif ?>
                    <?php mostar_mensaje() ?>
                </div>
            <?php endif; ?>


            <!-- COMIENZO DE AÑADIR ÓRDENES O PAGAR -->

            <?php
            $accion_a_realizar = $_GET["agregar"] ?? null;
            if (isset($accion_a_realizar)) :
            ?>
                <?php if ($accion_a_realizar == "pagar") : ?>
                    <!-- va primero pagar porque ordenar un pedido
                     y ordenar otro pedido son la misma acción
                     -->

                    <!-- VISTA DE PAGAR -->
                    <div class="contenedor-formulario">
                        <h3>Confirmar Pago</h3>
                        <p>¿Estás seguro que la Mesa <?= $mesa_actual["mesasID"] ?> terminó de comer y va a pagar?</p>
                        <p>Abonar: <?php 
                        $pdo = conexion();
                        $stmt = $pdo->prepare("SELECT SUM(total) FROM detalle_ordenes D INNER JOIN ordenes O ON D.detalle_ordenesID = O.detalle_ordenesID WHERE O.mesasID = ? AND estado = 'listo'");
                        $stmt->execute([$mesa_actual["mesasID"]]);
                        echo $stmt->fetchColumn(); ?></p>
                        <a href="server/php/mozo/actualizar-mesa.php?mesa=<?= $mesa_actual["mesasID"] ?>&accion=pagar" class="btn-accion btn-rojo">PAGAR</a>
                    </div>

                <?php else : ?>
                    <!-- VISTA DE AGREGAR PEDIDO (ordenar_pedido u ordenar_otro_pedido) -->
                    <div class="contenedor-formulario">
                        <form action="server/php/mozo/guardar-pedido.php" method="POST" class="form-pedido">

                            <!-- Enviamos el ID de la mesa oculto -->
                            <input type="hidden" name="mesasID" value="<?= $mesa_actual["mesasID"] ?>">

                            <!-- Selector de Comida (Entradas y Platos Principales) -->
                            <div class="form-group">
                                <label for="id_entrada">Entrada:</label>
                                <select name="id_entrada" id="id_entrada">
                                    <option value="">-- Seleccionar (Opcional) --</option>
                                    <?php foreach ($platos as $entrada_foreach): ?>
                                        <option value="<?= $entrada_foreach['platos_principalesID'] ?>" <?= ($entrada_foreach['cantidad'] == 0) ? 'disabled' : '' ?>>
                                            <?= $entrada_foreach['nombre'] ?> - $<?= $entrada_foreach['precio'] ?> <?= ($entrada_foreach['cantidad'] == 0) ? '(SIN STOCK)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Cantidad de Comida -->
                            <div class="form-group">
                                <label for="cantidad_entrada">Cantidad:</label>
                                <input type="number" name="cantidad_entrada" id="cantidad_entrada" value="1" min="1">
                            </div>

                            <div class="form-group">
                                <label for="id_plato_principal">Plato Principal:</label>
                                <select name="id_plato_principal" id="id_plato_principal">
                                    <option value="">-- Seleccionar (Opcional) --</option>
                                    <?php foreach ($platos as $platos_principales_foreach): ?>
                                        <option value="<?= $platos_principales_foreach['platos_principalesID'] ?>" <?= ($platos_principales_foreach['cantidad'] == 0) ? 'disabled' : '' ?>>
                                            <?= $platos_principales_foreach['nombre'] ?> - $<?= $platos_principales_foreach['precio'] ?> <?= ($platos_principales_foreach['cantidad'] == 0) ? '(SIN STOCK)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Cantidad de Comida -->
                            <div class="form-group">
                                <label for="cantidad_plato_principal">Cantidad:</label>
                                <input type="number" name="cantidad_plato_principal" id="cantidad_plato_principal" value="1" min="1">
                            </div>

                            <!-- Selector de Bebida -->
                            <div class="form-group">
                                <label for="id_bebida">Bebida:</label>
                                <select name="id_bebida" id="id_bebida">
                                    <option value="">-- Seleccionar (Opcional) --</option>
                                    <?php foreach ($bebidas as $b): ?>
                                        <option value="<?= $b['bebidasID'] ?>" <?= ($b['cantidad'] == 0) ? 'disabled' : '' ?>>
                                            <?= $b['nombre'] ?> - $<?= $b['precio'] ?> <?= ($b['cantidad'] == 0) ? '(SIN STOCK)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Cantidad de Bebida -->
                            <div class="form-group">
                                <label for="cantidad_bebida">Cantidad:</label>
                                <input type="number" name="cantidad_bebida" id="cantidad_bebida" value="1" min="1">
                            </div>

                            <!-- Selector de Postre -->
                            <div class="form-group">
                                <label for="id_postre">Postre:</label>
                                <select name="id_postre" id="id_postre">
                                    <option value="">-- Seleccionar (Opcional) --</option>
                                    <?php foreach ($postres as $postres_foreach): ?>
                                        <option value="<?= $postres_foreach['postresID'] ?>" <?= ($postres_foreach['cantidad'] == 0) ? 'disabled' : '' ?>>
                                            <?= $postres_foreach['nombre'] ?> - $<?= $postres_foreach['precio'] ?> <?= ($postres_foreach['cantidad'] == 0) ? '(SIN STOCK)' : '' ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Cantidad de Postres -->
                            <div class="form-group">
                                <label for="cantidad_postre">Cantidad:</label>
                                <input type="number" name="cantidad_postre" id="cantidad_postre" value="1" min="1">
                            </div>

                            <!-- Especificaciones -->
                            <div class="form-group">
                                <label for="especificaciones">Aclaraciones / Ingredientes específicos:</label>
                                <textarea name="especificaciones" id="especificaciones" rows="3" placeholder="Ej: Sin cebolla, para vegano, etc..."></textarea>
                            </div>

                            <div class="form-botones">
                                <button type="submit" class="btn-accion btn-verde">LISTO</button>
                                <a href="index.php?vista=MOZO&mesa=<?= $mesa_actual["mesasID"] ?>" class="btn-cancelar">Cancelar</a>
                            </div>
                        </form>
                    </div>
                <?php endif; ?>

            <?php endif; ?>
        </aside>
    </main>
</body>

</html>