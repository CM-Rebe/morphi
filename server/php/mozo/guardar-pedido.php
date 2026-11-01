<?php

require_once __DIR__ . "/../../../funciones.php";

//AGRUPACIÓN EN UN ARRAY + LIMPIEZA + NULLIDAD

$pedido = [
    //ID DE MESA
    "mesasID" => limpiar_cadena($_POST["mesasID"] ?? null),
    //ENTRADAS
    "id_entrada" => limpiar_cadena($_POST["id_entrada"] ?? null),
    "cantidad_entrada" => limpiar_cadena($_POST["cantidad_entrada"] ?? null),
    //PLATOS PRINCIPALES
    "id_plato_principal" => limpiar_cadena($_POST["id_plato_principal"]  ?? null),
    "cantidad_plato_principal" => limpiar_cadena($_POST["cantidad_plato_principal"] ?? null),
    //BEBIDAS
    "id_bebida" => limpiar_cadena($_POST["id_bebida"] ?? null),
    "cantidad_bebida" => limpiar_cadena($_POST["cantidad_bebida"] ?? null),
    //POSTRES
    "id_postre" => limpiar_cadena($_POST["id_postre"] ?? null),
    "cantidad_postre" => limpiar_cadena($_POST["cantidad_postre"] ?? null),
    //ESPECIFICACIONES
    "especificaciones" => limpiar_cadena($_POST["especificaciones"] ?? null)
];

//Que pasa

//Si uno es null, normalmente se descarta el pedido
//Pero si especificaciones (ejemplo) es null, no quiero
//que se me descarte el pedido ya que algunos pueden ordenar
//todo normal

//La definición de qué es lo mínimo para un pedido es:

//QUE MESASID NO SEA NULL
//QUE UNO DE LOS PEDIDOS NO SEA NULL
//QUE EN ESE PEDIDO SU CANTIDAD NO SEA NULL U 0(cero)

if (!isset($pedido["mesasID"])) {
    header("Location: ../../../index.php?vista=MOZO&&resultado=valores-faltantes");
    exit();
}

$id_mesa = $pedido["mesasID"];

$hay_entrada = !empty($pedido["id_entrada"]) && !empty($pedido["cantidad_entrada"]);
$hay_plato_principal   = !empty($pedido["id_plato_principal"]) && !empty($pedido["cantidad_plato_principal"]);
$hay_bebida  = !empty($pedido["id_bebida"]) && !empty($pedido["cantidad_bebida"]);
$hay_postre  = !empty($pedido["id_postre"]) && !empty($pedido["cantidad_postre"]);

if (!$hay_entrada && !$hay_plato_principal && !$hay_bebida && !$hay_postre) {
    header("Location: ../../../index.php?vista=MOZO&mesa=$id_mesa&resultado=valores-faltantes");
    exit();
}

//CALCULAR TOTAL DEL PEDIDO

$total = 0;

if ($hay_entrada) {
    $total += ejecutar_consulta_sql("SELECT SUM((precio * ?)) FROM entradas WHERE entradasID = ?",[$pedido["id_entrada"]]);
}

if ($hay_plato_principal) {
    $total += ejecutar_consulta_sql("SELECT SUM((precio * ?)) FROM entradas WHERE entradasID = ?",[$pedido["id_plato_principal"]]);
}

if ($hay_bebida) {
    $total += ejecutar_consulta_sql("SELECT SUM((precio * ?)) FROM entradas WHERE entradasID = ?",[$pedido["id_bebida"]]);
}

$pdo = conexion();

$stmt = $pdo->prepare("INSERT INTO detalle_ordenes (entradasID,
platos_principalesID,bebidasID,postresID,total,especificaciones) 
VALUES (?,?,?,?,?)");

$stmt->execute([$pedido["id_entrada"],$pedido["id_plato_principal"],$pedido["id_bebida"],$pedido["id_postre"],$total,$pedido["especificaciones"]]);

//OBTENEMOS EL ID PARA INSERTARLO EN LA ORDEN
$insertar_detalle_de_orden = $pdo->lastInsertId();

$insertar_orden = ejecutar_consulta_sql("INSERT INTO ordenes (mesasID,detalle_ordenesID) 
VALUES (?,?)",[$pedido["mesasID"],]);
