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

function ejecutar_consulta_sql($sql,$bindParam) {

    $pdo = conexion();
    $stmt = $pdo->prepare($sql);

    $stmt->execute($bindParam);

    //Si es UPDATE o DELETE contamos las columnas afectadas
    if (str_contains($sql,"UPDATE") || str_contains($sql,"DELETE")) {
        return $stmt->rowCount() ?? null;
    }
    //Sinó es SELECT o INSERT y agarramos los datos
    else {
        return $stmt->fetchAll() ?? null;
    }
    
}

//FUNCIONES DE MENSAJES

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
    //tipo de error, tipo de mensaje
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

    $resultado = $_GET["resultado"] ?? null;

    if (!isset($resultado)) {
        return;
    }

    switch ($resultado) {
        case 'ordenar_pedido':
            crear_mensaje("Exito:","pedido agregado con éxito");
        break;
        case 'ordenar_otro_pedido':
            crear_mensaje("Exito:","otro pedido agregado con éxito");
        break;
        case 'pagar':
            crear_mensaje("Exito:","pago exitoso");
        break;
        case 'fallo':
            crear_mensaje("Fallo:","ha habido un error en la actualización");
        break;
        case 'valores-faltantes':
            crear_mensaje("Fallo:","no se ha podido añadir el pedido debido a campos incompletos");
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

function limpiar_cadena($cadena) {
    return trim(stripslashes(htmlspecialchars($cadena)));
}
