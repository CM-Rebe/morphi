<?php

require_once __DIR__ . "/funciones.php";

$vista = $_GET["vista"] ?? "INICIAR_SESION";

if ($vista !== "INICIAR_SESION" && !isset($_SESSION["rol"])) {
    header("Location: index.php?vista=INICIAR_SESION");
    exit();
}

if ($vista === "INICIAR_SESION" && isset($_SESSION["rol"])) {
    switch ($_SESSION["rol"]) {
        case "mozo":
            header("Location: /index.php?vista=MOZO");
            exit();
        break;
        case "chef":
            header("Location: index.php?vista=CHEF");
            exit();
        break;
        case "admin":
            header("Location: index.php?vista=ADMIN");
            exit();
        break;
        default:
            header("Location: index.php?vista=INICIAR_SESION");
            exit();
        break;
    }
}

switch ($vista) {
    case 'INICIAR_SESION':
        require_once __DIR__ . "/server/php/vistas/iniciar-sesion.php";
        break;
    case 'MOZO':
        require_once __DIR__ . "/server/php/vistas/mozo.php";
        break;
    case 'CHEF':
        require_once __DIR__ . "/server/php/vistas/chef.php";
        break;
    case 'ADMIN':
        require_once __DIR__ . "/server/php/vistas/admin.php";
        break;
    default:
        echo "Vista no encontrada";
    break;
}
