<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D2 Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">

</head>

<body class="login">
    <div class="login-container">
        <div class="login-box">
            <div class="logo-container">
                <img src="styles/img/logoD2.png" alt="D2 Minimarket Logo" class="logo">
            </div>
            <form method="POST" action="index.php?controlador=login&accion=index">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>

</html>