<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>

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

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>