<?php require "views/shared/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h2><i class="fas fa-info-circle"></i> Detalles del Producto</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($data['producto'])): ?>
                        <ul class="list-group">
                            <li class="list-group-item"><strong><i class="fas fa-box"></i> Nombre:</strong> <?= $data['producto']['nombre_producto'] ?? 'N/A' ?></li>
                            <li class="list-group-item"><strong><i class="fas fa-dollar-sign"></i> Precio:</strong> $<?= number_format($data['producto']['precio_producto'] ?? 0, 2) ?></li>
                            <li class="list-group-item"><strong><i class="fas fa-cubes"></i> Cantidad:</strong> <?= $data['producto']['cantidad_producto'] ?? 'N/A' ?></li>
                            <li class="list-group-item"><strong><i class="fas fa-calendar-alt"></i> Fecha de Caducidad:</strong> <?= $data['producto']['fecha_caducidad'] ?? 'No aplica' ?></li>
                            <li class="list-group-item"><strong><i class="fas fa-leaf"></i> ¿Es Perecedero?</strong> 
                                <?= ($data['producto']['es_perecedero'] ?? 0) ? '<span class="badge bg-danger">Sí</span>' : '<span class="badge bg-success">No</span>' ?>
                            </li>
                            <li class="list-group-item"><strong><i class="fas fa-tags"></i> Categoría:</strong> <?= $data['producto']['id_categoria'] ?? 'N/A' ?></li>
                        </ul>

                        <div class="d-grid mt-4">
                            <a href="index.php?controlador=producto&accion=index" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger text-center">El producto no existe o no se encontró en la base de datos.</div>
                        <a href="index.php?controlador=producto&accion=index" class="btn btn-secondary d-block text-center">Volver</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "views/shared/footer.php"; ?>
