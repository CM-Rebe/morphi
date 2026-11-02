<?php

require_once __DIR__ . "/../../../funciones.php";

//AGRUPACIÓN EN UN ARRAY + LIMPIEZA + NULLIDAD

$pedido = [
    //ID DE MESA
    "mesasID" => (empty($_POST["mesasID"]) ? null : (int)$_POST["mesasID"]),
    //ENTRADAS
    "id_entrada" => (empty($_POST["id_entrada"]) ? null : (int)$_POST["id_entrada"]),
    "cantidad_entrada" => (empty($_POST["cantidad_entrada"]) ? null : (int)$_POST["cantidad_entrada"]),
    //PLATOS PRINCIPALES
    "id_plato_principal" => (empty($_POST["id_plato_principal"]) ? null : (int)$_POST["id_plato_principal"]),
    "cantidad_plato_principal" => (empty($_POST["cantidad_plato_principal"]) ? null : (int)$_POST["cantidad_plato_principal"]),
    //BEBIDAS
    "id_bebida" => (empty($_POST["id_bebida"]) ? null : (int)$_POST["id_bebida"]),
    "cantidad_bebida" => (empty($_POST["cantidad_bebida"]) ? null : (int)$_POST["cantidad_bebida"]),
    //POSTRES
    "id_postre" => (empty($_POST["id_postre"]) ? null : (int)$_POST["id_postre"]),
    "cantidad_postre" => (empty($_POST["cantidad_postre"]) ? null : (int)$_POST["cantidad_postre"]),
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

if (empty($pedido["mesasID"])) {
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

$pdo = conexion();

if ($hay_entrada) {
    $stmt = $pdo->prepare("SELECT SUM(precio * ?) FROM entradas WHERE entradasID = ?");
    $stmt->execute([$pedido["cantidad_entrada"], $pedido["id_entrada"]]);
    $total += $stmt->fetchColumn();
}

if ($hay_plato_principal) {
    $stmt = $pdo->prepare("SELECT SUM(precio * ?) FROM platos_principales WHERE platos_principalesID = ?");
    $stmt->execute([$pedido["cantidad_plato_principal"], $pedido["id_plato_principal"]]);
    $total += $stmt->fetchColumn();
}

if ($hay_bebida) {
    $stmt = $pdo->prepare("SELECT SUM(precio * ?) FROM bebidas WHERE bebidasID = ?");
    $stmt->execute([$pedido["cantidad_bebida"], $pedido["id_bebida"]]);
    $total += $stmt->fetchColumn();
}

if ($hay_postre) {
    $stmt = $pdo->prepare("SELECT SUM(precio * ?) FROM postres WHERE postresID = ?");
    $stmt->execute([$pedido["cantidad_postre"], $pedido["id_postre"]]);
    $total += $stmt->fetchColumn();
}

$stmt = $pdo->prepare("INSERT INTO detalle_ordenes (entradasID,
platos_principalesID,bebidasID,postresID,total,especificaciones) 
VALUES (?,?,?,?,?,?)");

$stmt->execute([$pedido["id_entrada"],$pedido["id_plato_principal"],$pedido["id_bebida"],$pedido["id_postre"],$total,$pedido["especificaciones"]]);

//OBTENEMOS EL ID PARA INSERTARLO EN LA ORDEN PORQUE PUEDE HABER MÁS DE 1 ORDEN IGUAL
//Y CON ESTA FUNCIÓN NO NECESITAMOS HACER ESO
$insertar_detalle_de_orden = $pdo->lastInsertId();

ejecutar_consulta_sql("INSERT INTO ordenes (mesasID,detalle_ordenesID,estado) 
VALUES (?,?,'proceso')",[$pedido["mesasID"],$insertar_detalle_de_orden]);

$stmt = $pdo->prepare("UPDATE mesas SET estado = 'ocupado' WHERE mesasID = ?");
$stmt->execute([$id_mesa]);

header("Location: ../../../index.php?vista=MOZO&mesa=$id_mesa&resultado=ordenar_pedido");