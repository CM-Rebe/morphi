<?php

require_once __DIR__ . "/../../../funciones.php";

$rol = strval($_POST["nombre"]);
$clave = strval($_POST["clave"]);

if (!isset($rol) || !isset($clave)) {
    header("Location: ../../../index.php?vista=INICIAR_SESION&error=400");
    exit();
}

if (verificar_datos("[a-zA-z0-9]{4,20}", $rol) === true) {
    header("Location: ../../../index.php?vista=INICIAR_SESION&error=400");
    exit();
}

if (verificar_datos("[a-zA-z0-9]{4,20}", $clave) === true) {
    header("Location: ../../../index.php?vista=INICIAR_SESION&error=400");
    exit();
}

$pdo = conexion();

$stmt = $pdo->prepare("SELECT r.nombre,u.clave FROM usuarios u INNER JOIN roles r ON r.rolesID = u.rolesID WHERE r.nombre = :rol");
$stmt->bindParam(":rol", $rol);
$stmt->execute();

$usuario = $stmt->fetch() ?? null;

if (isset($usuario)) {

    if (password_verify($clave, $usuario["clave"])) {

        $_SESSION["rol"] = $rol;
        echo "Entré";
        switch ($rol) {
            case "mozo":
                header("Location: ../../../index.php?vista=MOZO");
                exit();
            break;
            case "chef":
                header("Location: ../../../index.php?vista=CHEF");
                exit();
            break;
            case "admin":
                header("Location: ../../../index.php?vista=ADMIN");
                exit();
            break;
            default:
                header("Location: ../../../index.php?vista=INICIAR_SESION");
                exit();
            break;
        }
    } else {
        header("Location: ../../../index.php?vista=INICIAR_SESION&error=401");
        exit();
    }
}

header("Location: ../../../index.php?vista=INICIAR_SESION&error=404");
