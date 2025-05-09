<?php require "views/shared/header.php" ?>

<div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total venta</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['totalVentaDia'] as $venta): ?>
                <tr>
                    <td><?= $venta['fecha'] ?></td>
                    <td>$<?= number_format($venta['total_ventas'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?controlador=factura&accion=calculate&pdf=1" class="btn btn-danger mb-3 imprimir" target="_blank">
    Imprimir 
</a>

</div>
<?php require "views/shared/footer.php" ?>