<?php require "views/shared/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-warning text-dark">
                    <h2><i class="fas fa-edit"></i> Actualizar Producto</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($data['producto'])): ?>
                        <form action="index.php?controlador=producto&accion=actualizar" method="POST">
                            <input type="hidden" name="id" value="<?= $data['producto']['id_producto'] ?? '' ?>">

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-box"></i> Nombre</label>
                                <input type="text" name="nombre" class="form-control" value="<?= $data['producto']['nombre_producto'] ?? '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-dollar-sign"></i> Precio</label>
                                <input type="number" name="precio" class="form-control" step="0.01" value="<?= $data['producto']['precio_producto'] ?? '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-cubes"></i> Cantidad</label>
                                <input type="number" name="cantidad" class="form-control" value="<?= $data['producto']['cantidad_producto'] ?? '' ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Caducidad</label>
                                <input type="date" name="fecha_caducidad" class="form-control" value="<?= $data['producto']['fecha_caducidad'] ?? '' ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-leaf"></i> ¿Es Perecedero?</label>
                                <select name="es_perecedero" class="form-control">
                                    <option value="1" <?= ($data['producto']['es_perecedero'] == 1) ? 'selected' : '' ?>>Sí</option>
                                    <option value="0" <?= ($data['producto']['es_perecedero'] == 0) ? 'selected' : '' ?>>No</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-tags"></i> Categoría</label>
                                <input type="text" name="id_categoria" class="form-control" value="<?= $data['producto']['id_categoria'] ?? '' ?>">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
                                <a href="index.php?controlador=producto&accion=index" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Cancelar</a>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-danger mt-3 text-center">El producto no existe o no se encontró en la base de datos.</div>
                        <a href="index.php?controlador=producto&accion=index" class="btn btn-secondary d-block text-center">Volver</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "views/shared/footer.php"; ?>
