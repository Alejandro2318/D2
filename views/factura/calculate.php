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
</div>
<?php require "views/shared/footer.php" ?>