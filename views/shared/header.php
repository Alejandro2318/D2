<!DOCTYPE html>
<html lang="es" dir="ltr">

<!-- ESTO AUN NO VA A FUNCIONAR, SOLO LOGIN POR EL MOEMNTO -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">
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
                <img src="styles/img/logoD2.png" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="iconoPerson">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
                                id="Person--Streamline-Ionic-Filled" height="48" width="48">
                                <desc>Person Streamline Icon: https://streamlinehq.com</desc>
                                <path fill="#ffffff"
                                    d="M32.048 3.9009C30.0046 1.6949 27.1507 0.48 24.0008 0.48c-3.1669 0 -6.0302 1.2075 -8.064 3.3999 -2.0559 2.2165 -3.0576 5.2289 -2.8224 8.4819C13.5805 18.7794 18.4641 24 24.0008 24c5.5365 0 10.4117 -5.2196 10.8853 -11.6361 0.2383 -3.2235 -0.7697 -6.2297 -2.8381 -8.463Z"
                                    stroke-width="1"></path>
                                <path fill="#ffffff"
                                    d="M42.48 47.5197H5.52c-0.4838 0.0064 -0.9629 -0.0953 -1.4024 -0.2973 -0.4396 -0.2023 -0.8285 -0.4999 -1.1386 -0.8713 -0.6825 -0.8158 -0.9576 -1.9299 -0.7539 -3.0565 0.8862 -4.9161 3.6519 -9.0458 7.999 -11.9449C14.086 28.7763 18.9779 27.3598 24 27.3598s9.9141 1.4175 13.776 3.9899c4.347 2.8981 7.1127 7.0277 7.9989 11.9439 0.2037 1.1266 -0.0714 2.2407 -0.7539 3.0565 -0.3099 0.3716 -0.6989 0.6693 -1.1384 0.8717 -0.4396 0.2023 -0.9187 0.3042 -1.4026 0.2979Z"
                                    stroke-width="1"></path>
                            </svg>
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Usuarios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=index">Listar</a>
                            </li>
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=insert">Crear
                                    nuevo</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Botón de cerrar sesión -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn bg-danger text-white"
                            href="index.php?controlador=login&accion=logout">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>