<?php require "views/shared/header.php" ?>

<div class="container cuerpo">

    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">

        <thead>
            <tr>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['productos'] as $item) { ?>
                <tr>
                    <td><?= $item['nombre_producto'] ?></td>
                    <td>
                        <a href="index.php?controlador=producto&accion=view&id=<?= $item['id_producto'] ?>"
                            class="btn btn-info">Ver</a>
                        <?php if (isset($_SESSION['id_cargo']) && $_SESSION['id_cargo'] == 1) { ?>
                            <a href="index.php?controlador=producto&accion=edit&id=<?= $item['id_producto'] ?>"
                                class="btn btn-warning">Actualizar</a>
                            <a href="index.php?controlador=producto&accion=delete&id=<?= $item['id_producto'] ?>"
                                class="btn btn-danger"
                                onclick="event.preventDefault(); confirmarEliminacion(this.href, 'producto')">Eliminar</a>
                        <?php } ?>
                    </td>
                </tr>
                <!-- NORVY PARA ALERTA *****************************-->
                <!-- ALERTA SI LA CANTIDAD ES MENOR A 10 -->
                <!-- ALERTA SI LA CANTIDAD ES MENOR A 10 -->
                <?php if ($item['cantidad_producto'] < 10): ?>
                    <div id="custom-alert-overlay">
                        <div id="custom-alert-box">
                            <h5 class="custom-alert-title">¡Stock bajo!</h5>
                            <p>El producto "<?= $item['nombre_producto'] ?>" tiene solo <?= $item['cantidad_producto'] ?> unidades. ¡Por favor, reabastecer!</p>
                            <button class="botonCerrar" id="close-productos">Cerrar</button>
                        </div>
                    </div>
                <?php endif; ?>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require "views/shared/footer.php" ?>