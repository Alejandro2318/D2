<?php
require "views/shared/header.php";
?>

<div class="containerP">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>
    <div class="iconoP">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" id="Cash-Register--Streamline-Font-Awesome"
            height="48" width="48">
            <desc>Cash Register Streamline Icon: https://streamlinehq.com</desc>
            <!--! Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2024 Fonticons, Inc.-->
            <path
                d="M2 0C1.446875 0 1 0.446875 1 1v2c0 0.553125 0.446875 1 1 1h2.5v1H2.71875c-0.9875 0 -1.828125 0.721875 -1.978125 1.7L0.034375 11.378125c-0.021875 0.146875 -0.034375 0.296875 -0.034375 0.446875V14c0 1.103125 0.896875 2 2 2h12c1.103125 0 2 -0.896875 2 -2v-2.175c0 -0.15 -0.0125 -0.3 -0.034375 -0.45l-0.709375 -4.675c-0.146875 -0.978125 -0.9875 -1.7 -1.975 -1.7H6.5v-1h2.5c0.553125 0 1 -0.446875 1 -1V1c0 -0.553125 -0.446875 -1 -1 -1H2zm1 1.5h5c0.275 0 0.5 0.225 0.5 0.5s-0.225 0.5 -0.5 0.5H3c-0.275 0 -0.5 -0.225 -0.5 -0.5s0.225 -0.5 0.5 -0.5zM2 13.5c0 -0.275 0.225 -0.5 0.5 -0.5h11c0.275 0 0.5 0.225 0.5 0.5s-0.225 0.5 -0.5 0.5H2.5c-0.275 0 -0.5 -0.225 -0.5 -0.5zm1.5 -5.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm3.75 -0.75a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm5.25 -3.25a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5zm5.25 -3.25a0.75 0.75 0 1 1 -1.5 0 0.75 0.75 0 1 1 1.5 0zm-2.25 3.25a0.75 0.75 0 1 1 0 -1.5 0.75 0.75 0 1 1 0 1.5z"
                fill="#ffffff" stroke-width="0.0313"></path>
        </svg>
    </div>
    <form class="formulario mb-5" action="index.php?controlador=caja&accion=index" method="post">

        <?php if ($data['estadoCaja'] == 1): ?>
            <h1 class="text my-5 abierto"> Abierta </h1>
        <?php else: ?>
            <h1 class="text my-5 cerrado"> Cerrada </h1>
        <?php endif; ?>


        <button class="btn btn-warning actualizarEstado" data-estado="1">Abrir</button>
        <button class="btn btn-danger actualizarEstado" data-estado="0">Cerrar</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>