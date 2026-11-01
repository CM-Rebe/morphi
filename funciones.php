<?php

session_start();

//FUNCIONES PARA LA BASE DE DATOS

function conexion() {
    $pdo = new PDO('mysql:host=localhost;dbname=sistemas_operativos_clase_30_morphi;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $pdo;
}

function consulta($sql,$bindParam) {

    $pdo = conexion();
    $stmt = $pdo->prepare($sql);

    $stmt->execute($bindParam);

    if (verificar_datos("SELECT",$sql)) {
        return $stmt->fetchAll() ?? null;
    }
    if (verificar_datos("UPDATE",$sql)) {
        return $stmt->rowCount() ?? null;
    }
    
}

//FUNCIONES DE ERRORES

function mostrar_error() {
    function crear_error($error,$mensaje) {
        echo "
            <h2>Error $error</h2>
            <p>$mensaje</p>
        ";
    }

    $error = $_GET["error"] ?? null;

    if (!isset($error)) {
        return;
    }

    switch ($error) {
        case '400':
            crear_error($error,"faltan completar datos o no son los esperados");
        break;
        case '401':
            crear_error($error,"no estás autorizado para ingresar a esta cuenta");
        break;
        case '404':
            crear_error($error,"no estás autorizado para ingresar a esta cuenta");
        break;     
    }
}

function mostar_mensaje() {
    function crear_mensaje($realizacion,$mensaje) {
        echo "
            <h2>$realizacion</h2>
            <p>$mensaje</p>
        ";
    }

    $realizacion = $_GET["realizacion"] ?? null;

    if (!isset($realizacion)) {
        return;
    }

    switch ($realizacion) {
        case '1':
            crear_mensaje("Exito:","pedido agregado con éxito");
        break;
        case '2':
            crear_mensaje("Exito:","pago exitoso");
        break; 
        default :
            crear_mensaje("Fallo:","ha habido un error en la actualización");
        break;
    }
}

//FUNCIONES DE AFECTAR CADENAS

function verificar_datos($filtro, $cadena){
    return !preg_match("/^".$filtro."$/u", $cadena);
}

function sacar_caracteres_html($cadena){
    return htmlspecialchars($cadena);
}

function sacar_barras($cadena){
    return stripslashes($cadena);
}

function sacar_espacios($cadena){
    return trim($cadena);
}

