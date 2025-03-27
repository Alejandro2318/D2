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
    <script src="app/app.js"></script>

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


                <!-- usuarios -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="icono">
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
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=index">Listar
                                    Usuarios</a>
                            </li>
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=insert">Crear
                                    nuevo Usuario</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- productos -->

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="icono">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
                                id="Cart--Streamline-Ionic-Filled" height="48" width="48">
                                <desc>Cart Streamline Icon: https://streamlinehq.com</desc>
                                <path fill="#ffffff"
                                    d="M16.2233 44.9917c1.932 0 3.4982 -1.5663 3.4982 -3.4983s-1.5662 -3.4983 -3.4982 -3.4983c-1.932 0 -3.4984 1.5662 -3.4984 3.4983 0 1.932 1.5664 3.4983 3.4984 3.4983Z"
                                    stroke-width="1"></path>
                                <path fill="#ffffff"
                                    d="M40.7143 44.9917c1.932 0 3.4983 -1.5663 3.4983 -3.4983s-1.5663 -3.4983 -3.4983 -3.4983 -3.4982 1.5662 -3.4982 3.4983c0 1.932 1.5662 3.4983 3.4982 3.4983Z"
                                    stroke-width="1"></path>
                                <path fill="#ffffff"
                                    d="M46.9228 9.2159c-0.2458 -0.3006 -0.5554 -0.5426 -0.9063 -0.7086 -0.3509 -0.166 -0.7346 -0.2518 -1.1228 -0.2512H11.6195l-0.6702 -3.8025c-0.0715 -0.405 -0.2834 -0.7719 -0.5985 -1.0362 -0.3151 -0.2643 -0.7132 -0.4092 -1.1245 -0.4091h-6.997c-0.464 0 -0.9089 0.1843 -1.237 0.5124S0.48 4.2936 0.48 4.7576c0 0.4639 0.1843 0.9088 0.5123 1.2369 0.3281 0.328 0.773 0.5123 1.237 0.5123h5.5298l4.992 28.2922c0.0715 0.405 0.2834 0.7719 0.5985 1.0361 0.315 0.2644 0.7132 0.4092 1.1245 0.4091h27.9881c0.4639 0 0.9089 -0.1842 1.237 -0.5123s0.5123 -0.7731 0.5123 -1.237c0 -0.4638 -0.1843 -0.9088 -0.5123 -1.2368s-0.7731 -0.5123 -1.237 -0.5123H15.9413l-0.6167 -3.4986h26.4205c0.6066 -0.0008 1.1944 -0.2111 1.6637 -0.5955 0.4693 -0.3842 0.7916 -0.9189 0.912 -1.5134l3.1486 -15.7433c0.0759 -0.3812 0.0663 -0.7743 -0.0282 -1.151 -0.0946 -0.3769 -0.2716 -0.7279 -0.5184 -1.0281Z"
                                    stroke-width="1"></path>
                            </svg>
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controlador=producto&accion=index">Listar
                                    Productos</a>
                            </li>

                            <li><a class="dropdown-item" href="index.php?controlador=producto&accion=insert">Crear

                                    nuevo Producto</a></li>
                        </ul>
                    </li>
                </ul>


                <!-- VENTAS -->

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="icono">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
                                id="Card--Streamline-Ionic-Filled" height="48" width="48">
                                <desc>Card Streamline Icon: https://streamlinehq.com</desc>
                                <path fill="#ffffff"
                                    d="M0.48 36.5996c0 1.5594 0.6195 3.055 1.7222 4.1577 1.1027 1.1028 2.5983 1.7222 4.1578 1.7222h35.28c1.5594 0 3.0551 -0.6194 4.1578 -1.7222 1.1027 -1.1027 1.7222 -2.5983 1.7222 -4.1577v-16.17H0.48v16.17Zm6.93 -7.98c0 -0.8354 0.3319 -1.6367 0.9226 -2.2274 0.5908 -0.5908 1.3921 -0.9227 2.2274 -0.9227h5.04c0.8353 0 1.6366 0.3319 2.2274 0.9227 0.5907 0.5907 0.9226 1.392 0.9226 2.2274v2.0999c0 0.8354 -0.3319 1.6367 -0.9226 2.2274 -0.5908 0.5908 -1.3921 0.9226 -2.2274 0.9226h-5.04c-0.8353 0 -1.6366 -0.3318 -2.2274 -0.9226 -0.5907 -0.5907 -0.9226 -1.392 -0.9226 -2.2274v-2.0999Z"
                                    stroke-width="1"></path>
                                <path fill="#ffffff"
                                    d="M41.64 5.5205H6.36c-1.5595 0 -3.0551 0.6195 -4.1578 1.7222S0.48 9.841 0.48 11.4005v2.7299h47.04v-2.7299c0 -1.5595 -0.6195 -3.0551 -1.7222 -4.1578S43.1994 5.5205 41.64 5.5205Z"
                                    stroke-width="1"></path>
                            </svg>
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Ventas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=index">Listar</a>
                            </li>
                            <li><a class="dropdown-item" href="index.php?controlador=usuario&accion=insert">Crear
                                    nuevo</a></li>
                        </ul>
                    </li>
                </ul>



                <!-- Caja -->

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="icono">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                id="Cash-Register--Streamline-Font-Awesome" height="48" width="48">
                                <desc>Cash Register Streamline Icon: https://streamlinehq.com</desc>
                                <!--! Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M2 0C1.446875 0 1 0.446875 1 1v2c0 0.553125 0.446875 1 1 1h2.5v1H2.71875c-0.9875 0 -1.828125 0.721875 -1.978125 1.7L0.034375 11.378125c-0.021875 0.146875 -0.034375 0.296875 -0.034375 0.446875V14c0 1.103125 0.896875 2 2 2h12c1.103125 0 2 -0.896875 2 -2v-2.175c0 -0.15 -0.0125 -0.3 -0.034375 -0.45l-0.709375 -4.675c-0.146875 -0.978125 -0.9875 -1.7 -1.975 -1.7H6.5v-1h2.5c0.553125 0 1 -0.446875 1 -1V1c0 -0.553125 -0.446875 -1 -1 -1H2zm1 1.5h5c0.275 0 0.5 0.225 0.5 0.5s-0.225 0.5 -0.5 0.5H3c-0.275 0 -0.5 -0.225 -0.5 -0.5s0.225 -0.5 0.5 -0.5zM2 13.5c0 -0.275 0.225 -0.5 0.5 -0.5h11c0.275 0 0.5 0.225 0.5 0.5s-0.225 0.5 -0.5 0.5H2.5c-0.275 0 -0.5 -0.225 -0.5 -0.5zm1.5 -5.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm3.75 -0.75a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm5.25 -3.25a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm5.25 -3.25a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5z"
                                    fill="#ffffff" stroke-width="0.0313"></path>
                            </svg>
                        </div>
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Caja
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