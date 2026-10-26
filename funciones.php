<?php

session_start();

function conexion() {
    $pdo = new PDO('mysql:host=localhost;dbname=sistemas_operativos_clase_30_morphi;charset=utf8mb4', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    return $pdo;
}

function mostrar_error() {
    function crear_error($error,$mensaje) {
        return "
            <h2>Error $error</h2>
            <p>$mensaje</p>
        ";
    }

    $error = $_GET["error"] ?? "";
    if ($error !== "") {
        return;
    }
    switch ($error) {
        case '400':
            crear_error($error,"no se encontró la persona");
        break;
        case '401':
            crear_error($error,"no estás autorizado para ingresar a esta cuenta");
        break;
        case '404':
            
        break;     
        default:
        
        break;
    }
}

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