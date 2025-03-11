<!DOCTYPE html>
<html lang="es" dir="ltr">

<!-- ESTO AUN NO VA A FUNCIONAR, SOLO LOGIN POR EL MOEMNTO -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="./assets/css/style.css">
    <title>
        <?= $data['titulo'] ?>
    </title>

    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
    <div class="container">
        <a class="navbar-brand" href="./">
            <img src="./assets/img/invoice.png" alt="logo">
            <span class="span-logo">Factu</span>Soft
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controlador=producto&accion=index">Listar</a></li>
                        <li><a class="dropdown-item" href="index.php?controlador=producto&accion=insert">Crear nuevo</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controlador=cliente&accion=index">Listar</a></li>
                        <li><a class="dropdown-item" href="index.php?controlador=cliente&accion=insert">Crear nuevo</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Facturas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="index.php?controlador=venta&accion=index">Listar</a></li>
                        <li><a class="dropdown-item" href="index.php?controlador=venta&accion=insert">Nueva Venta</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Botón de cerrar sesión -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn bg-danger text-white" href="index.php?controlador=login&accion=logout">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
