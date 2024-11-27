<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VisualControl</title>
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="header-placeholder"></div>
    <main>
        <section id="login">
            <div class="form-container">
                <h2>Login</h2>
                <form method="POST" action= "log.php">
                    <input type="text" name="username" placeholder="Nombre de usuario" required>
                    <input type="password" name="password" placeholder="Contraseña" required>
                    <button type="submit">Iniciar Sesión</button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <div id="footer-placeholder"></div>
    <script src="script.js"></script>
</body>
</html>