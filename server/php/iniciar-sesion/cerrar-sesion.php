<?php
session_start();
$_SESSION["id"] = "";
session_destroy();
header("Location: ../../../index.php?vista=INICIAR_SESION");
?>