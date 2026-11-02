<?php
require_once __DIR__ . "/../../../funciones.php";

$id_orden = $_GET["id"] ?? null;

if (!isset($id_orden)) {
    header("Location: ../../../index.php?vista=CHEF&resultado=fallo");
    exit();
}

$consulta = ejecutar_consulta_sql("UPDATE ordenes SET estado = 'listo' WHERE ordenesID = ?", [$id_orden]);

if ($consulta) {
    header("Location: ../../../index.php?vista=CHEF");
    exit();
}

header("Location: ../../../index.php?vista=CHEF&resultado=fallo");
?>