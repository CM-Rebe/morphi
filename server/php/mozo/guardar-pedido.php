<?php

require_once __DIR__ . "/../../../funciones.php";

$pedido = [
    //ID DE MESA
    "mesasID" => limpiar_cadena($_POST["mesasID"]) ?? null,
    //ENTRADAS & PLATOS PRINCIPALES
    "comida" => limpiar_cadena($_POST["comida"]) ?? "",
    "cantidad_comida" => limpiar_cadena($_POST["cantidad_comida"]) ?? "",
    //BEBIDAS
    "bebida" => limpiar_cadena($_POST["bebida"]) ?? "",
    "cantida_bebida" => limpiar_cadena($_POST["cantidad_bebida"]) ?? "",
    //POSTRES
    "postre" => limpiar_cadena($_POST["postre"]) ?? "",
    "cantidad_postre" => limpiar_cadena($_POST["cantidad_postre"]) ?? "",
    //ESPECIFICACIONES
    "especificaciones" => limpiar_cadena($_POST["especificaciones"]) ?? ""
];

//VER NULL

foreach ($pedido as $pedido_valor_foreach) {
    if (!isset($pedido_valor_foreach)) {
        header("Location: ../../../index.php?vista=MOZO&resultado=fallo");
        exit();
    }
}

//CALCULAR TOTAL DEL PEDIDO

$total = ejecutar_consulta_sql("SELECT SUM(E.precio + platos_principales.precio + B.precio + postres.precio) FROM detalle_ordenes D 
        INNER JOIN entradas E
        ON E.entradasID = D.entradasID
        INNER JOIN platos_principales
        ON platos_principales.platos_principalesID = D.platos_principalesID
        INNER JOIN bebidas B
        ON B.bebidasID = D.bebidasID
        INNER JOIN postres
        ON postres.postresID = D.postresID",null);

$pdo = conexion();

$stmt = $pdo->prepare("INSERT INTO detalle_ordenes (entradasID,
platos_principalesID,bebidasID,postresID,especificaciones) 
VALUES (?,?,?,?,?)");

$stmt->execute([$total,$pedido["especificaciones"]]);

//OBTENEMOS EL ID PARA INSERTARLO EN LA ORDEN
$insertar_detalle_de_orden = $pdo->lastInsertId();

$insertar_orden = ejecutar_consulta_sql("INSERT INTO ordenes (mesasID,detalle_ordenesID) 
VALUES (?,?)",[$pedido["mesasID"],]);
