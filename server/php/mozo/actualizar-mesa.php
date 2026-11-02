<?php

require_once __DIR__ . "/../../../funciones.php";

$numeroMesa = $_GET["mesa"] ?? null;
$accion = $_GET["accion"] ?? null;

if (empty($numeroMesa) || $accion !== "pagar") {
    header("Location: ../../../index.php?vista=MOZO&resultado=fallo");
    exit();
}

$actualizar_mesa = ejecutar_consulta_sql("UPDATE mesas SET estado = 'libre' WHERE mesasID = ?", [$numeroMesa]);
$actualizar_ordenes = ejecutar_consulta_sql("UPDATE ordenes SET estado = 'pagado' WHERE mesasID = ? AND estado != 'pagado'",[$numeroMesa]);

if (isset($actualizar_mesa) && isset($actualizar_ordenes)) {
    header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=ordenar_pedido");
    exit();
} else {
    header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=pagar");
    exit();
}