<?php
session_start();
$_SESSION["id"] = "";
$_SESSION["nombre"] = "";
session_destroy();
header("Location: ../../../index.php?vista=INICIAR_SESION");
?>