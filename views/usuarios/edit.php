<?php require "views/shared/header.php" ?>

<div class="containerP">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>
    <div class="iconoP">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48"
            id="Person-Circle--Streamline-Ionic-Filled" height="48" width="48">
            <desc>Person Circle Streamline Icon: https://streamlinehq.com</desc>
            <path fill="#ffffff"
                d="M23.9999 0.48C11.0312 0.48 0.48 11.0312 0.48 24.0001 0.48 36.9688 11.0312 47.52 23.9999 47.52c12.9689 0 23.5201 -10.5512 23.5201 -23.5199C47.52 11.0312 36.9688 0.48 23.9999 0.48Zm-5.6786 13.2096c1.4327 -1.5186 3.4488 -2.3542 5.6786 -2.3542s4.228 0.8413 5.6664 2.3678c1.4575 1.547 2.1665 3.6253 1.9991 5.8597 -0.3346 4.4372 -3.7722 8.0556 -7.6655 8.0556s-7.3374 -3.6184 -7.6654 -8.0568c-0.1662 -2.2525 0.5416 -4.3376 1.9868 -5.8721Zm5.6786 30.2119c-2.6567 0.0018 -5.2868 -0.53 -7.7341 -1.5637 -2.4475 -1.0338 -4.6625 -2.5484 -6.5135 -4.4543 1.0602 -1.5118 2.411 -2.7972 3.9735 -3.7812 2.8824 -1.8477 6.5302 -2.8653 10.2741 -2.8653 3.744 0 7.3919 1.0176 10.2708 2.8653 1.5639 0.9835 2.9158 2.2689 3.977 3.7812 -1.851 1.9062 -4.0659 3.4209 -6.5133 4.4547 -2.4475 1.0337 -5.0776 1.5653 -7.7345 1.5633Z"
                stroke-width="1"></path>
        </svg>
    </div>
    <form id="formularioActualizar" class="formulario mb-5" action="index.php?controlador=usuario&accion=update" method="post">
        <input type="hidden" name="id_usuario" value="<?= $data['id_usuario'] ?>">
        <div class="formulario__cont">
            <div class="formulario__cont2">
                <div class="formulario__cont-sec">
                    <label for="nombre_usuario" class="form-label">Nombre Usuario</label>
                    <input type="text" class="formulario__cont-input form-control" id="nombre_usuario"
                        name="nombre_usuario">
                </div>
                <div class="formulario__cont-sec">
                    <label for="contraseña" class="form-label">Contraseña</label>
                    <input type="text" class="formulario__cont-input form-control" id="contraseña" name="contraseña">
                </div>

                <div class="formulario__cont-sec">
                    <label for="id_cargo" class="form-label">Cargo</label>
                    <select id="id_cargo" name="id_cargo" class="form-control">
                        <?php foreach ($data['cargos'] as $cargo): ?>
                            <option value="<?= $cargo['id_cargo']; ?>">
                                <?= htmlspecialchars($cargo['tipo_cargo']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

        </div>
        <button type="button" class="btnform btn-primary" onclick="updateConfirmModal('usuario')">Guardar</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>