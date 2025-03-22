
<?php require "views/shared/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h2><i class="fas fa-boxes"></i> Listado de Productos</h2>
                </div>
                <div class="card-body">
                    
                    <div class="d-flex justify-content-end mb-3">
                        <a href="index.php?controlador=producto&accion=crear" class="btn btn-success">
                            <i class="fas fa-plus"></i> Nuevo Producto
                        </a>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th><i class="fas fa-box"></i> Producto</th>
                                <th class="text-center"><i class="fas fa-cogs"></i> Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['productos'] as $item) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($item['nombre_producto']) ?></td>
                                    <td class="text-center">
                                        <a href="index.php?controlador=producto&accion=ver&id=<?= $item['id_producto'] ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="index.php?controlador=producto&accion=editar&id=<?= $item['id_producto'] ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Actualizar
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmarEliminacion(<?= $item['id_producto'] ?>)">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmarEliminacion(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.")) {
            window.location.href = "index.php?controlador=producto&accion=delete&id=" + id;
        }
    }
</script>

<?php require "views/shared/footer.php"; ?>
