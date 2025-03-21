<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D2 Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121D1B;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .login-container {
            width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            border: solid white 3px;
        }

        .login-box {
            background-color: #1E2D2B;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .logo-container {
            background-color: #3E5C50;
            padding: 20px;
            border-radius: 15px;
            display: inline-block;
            margin-bottom: 20px;
        }

        .logo {
            width: 200px;
            height: auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 20px;
            border: 1px solid #ffffff;
            background-color: #fff;
        }

        button {
            transition: all 0.3s ease;
            background-color: #4a7368;
            border: none;
            padding: 15px 10px;
            border-radius: 15px;
            color: white;
            font-size: 20px;
            cursor: pointer;
            width: 50%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #356A5C;
            font-size: 23px;
        }
    </style>
</head>

<body>
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