<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <header>
        <h1>INICIAR SESIÓN</h1>
    </header>
    <main>
        <form action="server/php/iniciar-sesion/ingresar.php" method="POST">
            <section>
                <label for="nombre">Nombre</label>
                <select name="nombre" id="nombre" required>
                    <option value="mozo">Mozo</option>
                    <option value="chef">Chef</option>
                    <option value="admin">Admin</option>
                </select>
            </section>
            <section>
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" required minlength="4" maxlength="20">
            </section>
            <?php
                require_once __DIR__ . "/../../../funciones.php";
                mostrar_error();
            ?>
            <button type="submit">Enviar</button>
        </form>
    </main>
    <footer>
        <p></p>
    </footer>
</body>
</html>