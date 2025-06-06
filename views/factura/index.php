<?php require "views/shared/header.php" ?>

<div class="container cuerpo"> <!--agregue el cuerpo para llevar el mismo diseño  -->
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Ventas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['facturas'] as $item) { ?>
                <tr>
                    <td><?= $item['id_factura'] . " / " . $item['fecha_factura'] ?></td>
                    <td>
                        <a href="index.php?controlador=factura&accion=view&id=<?= $item['id_factura'] ?>"
                            class="btn btn-info">Ver</a>
                        <a href="index.php?controlador=factura&accion=descargarFactura&id_factura=<?= $item['id_factura'] ?>&descargar=1"
                            class="btn btn-warning" target="_blank">Imprimir</a>
                        <?php if (isset($_SESSION['id_cargo']) && $_SESSION['id_cargo'] == 1) { ?>
                            <a href="index.php?controlador=factura&accion=delete&id=<?= $item['id_factura'] ?>"
                                class="btn btn-danger"
                                onclick="event.preventDefault(); confirmarEliminacion(this.href, 'factura')">Eliminar</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require "views/shared/footer.php" ?>