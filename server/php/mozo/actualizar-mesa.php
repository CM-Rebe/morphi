<?php

require_once __DIR__ . "/../../../funciones.php";

$numeroMesa = $_GET["mesa"] ?? null;
$estadoMesa = $_GET["estado"] ?? null;

if (!isset($numeroMesa) || !isset($estadoMesa)) {
    header("Location: ../../../index.php?vista=MOZO");
    exit();
}

$consulta = consulta("UPDATE mesas SET estado = ? WHERE mesasID = ?",[$estadoMesa,$numeroMesa]);

if (isset($consulta)) {
    header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&realizacion=1");
}

header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&realizacion=1");