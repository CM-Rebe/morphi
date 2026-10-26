<?php

require_once __DIR__ . "/funciones.php";

$vista = $_GET["vista"] ? $_GET["vista"] : "INICIAR_SESION";

if ($vista === "PRINCIPAL" && !isset($_SESSION["id"])) {
    header("Location: index.php?vista=INICIAR_SESION");
    exit();
}

if ($vista !== "PRINCIPAL" && isset($_SESSION["id"])) {
    header("Location: index.php?vista=PRINCIPAL");
    exit();
}

switch ($vista) {
    case 'PRINCIPAL':
        require_once __DIR__ . "/server/php/vistas/principal.php";
    break;
    case 'INICIAR_SESION':
        require_once __DIR__ . "/server/php/vistas/pagina-iniciar-sesion.php";
    break;
    default:
    echo "Vista no encontrada";
    break;
}

?>