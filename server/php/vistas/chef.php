<?php 
    require_once __DIR__ . "/../../../funciones.php";

    $ordenes = consulta("SELECT O.mesasID, E.nombre, platos_principales.nombre, B.nombre, postres.nombre ,D.detalle_ordenesID FROM ordenes O 
        INNER JOIN detalle_ordenes D
        ON O.detalle_ordenesID = D.detalle_ordenesID
        INNER JOIN entradas E
        ON E.entradasID = D.entradasID
        INNER JOIN platos_principales
        ON platos_principales.platos_principalesID = D.platos_principalesID
        INNER JOIN bebidas B
        ON B.bebidasID = D.bebidasID
        INNER JOIN postres
        ON postres.postresID = D.postresID
    ",null);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEF</title>
    <link rel="shortcut icon" href="assets/img/logo-morphy.jpg" type="image/x-icon">

</head>
<body>
        
</body>
</html>