<?php require "views/shared/header.php" ?>

<div class="containerP">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <p class="text-dark">
        <span class="fw-bold">Fecha:</span>
        <?= date('Y-m-d', strtotime($data['factura']['fecha_factura'])) ?>
    </p>
    <p class="text-dark">
        <span class="fw-bold">Hora:</span>
        <?= date('H:i:s', strtotime($data['factura']['fecha_factura'])) ?>
    </p>
    <p class="text-dark">
        <span class="fw-bold">Cajero:</span>
        <?= $data['factura']['nombre_usuario'] ?>
    </p>
    <p class="text-dark">
        <span class="fw-bold">ID:</span>
        <?= number_format($data['factura']['id_usuario'], 0, '.', '.') ?>
    </p>
    <p class="text-dark">
        <span class="fw-bold">Caja:</span>
        <?= $data['factura']['id_caja'] ?>
    </p>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['detallesVenta'] as $item) { ?>
                <tr>
                    <td><?= $item['nombre_producto'] ?></td>
                    <td>
                        <?= $item['cantidad_producto_venta'] ?>
                    </td>
                    <td>
                        $<?= number_format($item['precio_producto'], 0, '.', '.') ?>
                    </td>

                    <td>
                        $<?= number_format($item['subtotal'], 0, '.', '.') ?>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td>TOTAL</td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    $<?= number_format($data['factura']['total_factura'], 0, '.', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>
    <a href="index.php?controlador=factura" class="btn btn-ver">Volver</a>

</div>

<?php require "views/shared/footer.php" ?>