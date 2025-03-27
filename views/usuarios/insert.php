<?php
require "views/shared/header.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_cargo']) || $_SESSION['id_cargo'] != 1) {

    echo '
        <div id="custom-alert-overlay">
            <div id="custom-alert-box">
                <h5 class="custom-alert-title">Acceso Denegado</h5>
                <p>Solo los administradores pueden agregar nuevos productos.</p>
                <button id="close-alert-btn">Cerrar</button>
            </div>
        </div>
    ';
    exit;
}
?>

<?php require "views/shared/header.php" ?>

<div class="containerP">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>
    <div class="iconoP">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" id="Person-Add--Streamline-Ionic-Filled"
            height="48" width="48">
            <desc>Person Add Streamline Icon: https://streamlinehq.com</desc>
            <path fill="#ffffff"
                d="M26.9986 23.9997c4.949 0 9.3215 -4.6602 9.7499 -10.3892 0.2128 -2.8781 -0.69 -5.56213 -2.5425 -7.55617C32.3733 4.08467 29.8111 3 26.9986 3c-2.8349 0 -5.3989 1.07811 -7.2186 3.03558 -1.8403 1.97904 -2.7375 4.66872 -2.5312 7.57302 0.4209 5.7299 4.7924 10.3911 9.7498 10.3911Z"
                stroke-width="1"></path>
            <path fill="#ffffff"
                d="M46.4414 41.2273c-0.7912 -4.3893 -3.2615 -8.0764 -7.1427 -10.6639C35.8516 28.2656 31.4838 27 26.9998 27s-8.8517 1.2656 -12.2989 3.5625c-3.8812 2.5874 -6.35149 6.2746 -7.14273 10.6639 -0.18093 1.0059 0.06469 2.0006 0.67406 2.729 0.27639 0.332 0.62343 0.598 1.01578 0.7787 0.39237 0.1806 0.82009 0.2714 1.25209 0.2657h32.9995c0.4321 0.0061 0.8602 -0.0844 1.2529 -0.2649 0.3927 -0.1805 0.74 -0.4465 1.0168 -0.7786 0.6075 -0.7284 0.8531 -1.7231 0.6721 -2.729Z"
                stroke-width="1"></path>
            <path fill="#ffffff"
                d="M9.74874 26.9982v-3.7495h3.74946c0.3977 0 0.7792 -0.158 1.0605 -0.4392 0.2812 -0.2813 0.4392 -0.6628 0.4392 -1.0605 0 -0.3977 -0.158 -0.7793 -0.4392 -1.0606 -0.2813 -0.2812 -0.6628 -0.4392 -1.0605 -0.4392H9.74874v-3.7494c0 -0.3977 -0.15804 -0.7793 -0.43927 -1.0606C9.02821 15.158 8.64674 15 8.24897 15c-0.39777 0 -0.77923 0.158 -1.0605 0.4392 -0.28126 0.2813 -0.43927 0.6629 -0.43927 1.0606v3.7494H2.99977c-0.39777 0 -0.77923 0.158 -1.0605 0.4392 -0.28126 0.2813 -0.43927 0.6629 -0.43927 1.0606 0 0.3977 0.15801 0.7792 0.43927 1.0605 0.28127 0.2812 0.66273 0.4392 1.0605 0.4392H6.7492v3.7495c0 0.3977 0.15801 0.7792 0.43927 1.0605 0.28127 0.2812 0.66273 0.4392 1.0605 0.4392 0.39777 0 0.77924 -0.158 1.0605 -0.4392 0.28123 -0.2813 0.43927 -0.6628 0.43927 -1.0605Z"
                stroke-width="1"></path>
        </svg>
    </div>
    <form class="formulario mb-5" action="index.php?controlador=usuario&accion=store" method="post">

        <div class="formulario__cont">
            <div class="formulario__cont2">
                <div class="formulario__cont-sec">
                    <label for="nombre_usuario" class="form-label">Nombre Usuario</label>
                    <input type="text" class="formulario__cont-input form-control" id="nombre_usuario"
                        name="nombre_usuario" required>
                </div>
                <div class="formulario__cont-sec">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="text" class="formulario__cont-input form-control" id="contraseña" name="contraseña"
                        required>
                </div>

                <div class="formulario__cont-sec">
                    <label for="id_cargo" class="form-label">Cargo</label>
                    <select id="id_cargo" name="id_cargo" class="form-control" required>
                        <?php foreach ($data['cargos'] as $cargo): ?>
                            <option value="<?= $cargo['id_cargo']; ?>">
                                <?= htmlspecialchars($cargo['tipo_cargo']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

        </div>

        <button type="submit" class="btnform btn-primary">Crear</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>