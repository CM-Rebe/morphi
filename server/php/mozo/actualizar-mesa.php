<?php

require_once __DIR__ . "/../../../funciones.php";

$numeroMesa = $_GET["mesa"] ?? null;
$accion = $_GET["accion"] ?? null;

if (!isset($numeroMesa) || !isset($accion)) {
    header("Location: ../../../index.php?vista=MOZO&realizacion=fallo");
    exit();
}

//$estado es solo para la consulta sql

//Si pedimos algo, entonces está ocupado
$estado = ($accion == "ordenar_pedido") ? "ocupado" : 
//Si no pedimos nada, es porque paga (y queda libre al pagar)
($accion == "ordenar_otro_pedido" ? "ocupado" : "libre");

$consulta = ejecutar_consulta_sql("UPDATE mesas SET estado = ? WHERE mesasID = ?",[$estado,$numeroMesa]);

if (isset($consulta)) {
    if ($accion == "ordenar_pedido") {
        header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=ordenar_pedido");
        exit();
    }
    elseif ($accion == "ordenar_otro_pedido") {
        header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=ordenar_otro_pedido");
        exit();
    }
    else {
        header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=pagar");
        exit();
    }
}

header("Location: ../../../index.php?vista=MOZO&mesa=$numeroMesa&resultado=fallo");