<?php require "views/shared/header.php" ?>

<div class="container cuerpo">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad en Stock</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['productosBajoStock'] as $productos): ?>
                <tr>
                    <td><?= $productos['nombre_producto'] ?></td>
                    <td><?= $productos['cantidad_producto']?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require "views/shared/footer.php" ?>