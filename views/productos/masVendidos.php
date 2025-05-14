<?php require "views/shared/header.php" ?>

<div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Total Vendido</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['productosMasVendidos'] as $producto): ?>
                <tr>
                <td class="text-center"><?= $producto['nombre_producto'] ?></td>
                <td class="text-center"><?= $producto['total_vendidos'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require "views/shared/footer.php" ?>
