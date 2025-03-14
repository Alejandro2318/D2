<?php require "views/shared/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-success text-white">
                    <h2><i class="fas fa-plus-circle"></i> Agregar Nuevo Producto</h2>
                </div>
                <div class="card-body">
                    <form action="index.php?controlador=producto&accion=store" method="post">
                        
                        <div class="mb-3">
                            <label for="nombre_producto" class="form-label"><i class="fas fa-box"></i> Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                        </div>

                        <div class="mb-3">
                            <label for="precio_producto" class="form-label"><i class="fas fa-dollar-sign"></i> Precio</label>
                            <input type="number" class="form-control" id="precio_producto" name="precio_producto" required>
                        </div>

                        <div class="mb-3">
                            <label for="cantidad_producto" class="form-label"><i class="fas fa-cubes"></i> Cantidad</label>
                            <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-leaf"></i> ¿Es Perecedero?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-yes" value="1" onchange="toggleExpirationDate()">
                                <label class="form-check-label" for="es_perecedero-yes">Sí</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-no" value="0" checked onchange="toggleExpirationDate()">
                                <label class="form-check-label" for="es_perecedero-no">No</label>
                            </div>
                        </div>

                        <div class="mb-3" id="expiration-date-group" style="display: none;">
                            <label for="fecha_caducidad" class="form-label"><i class="fas fa-calendar-alt"></i> Fecha de Vencimiento</label>
                            <input type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad">
                        </div>

                        <div class="mb-3">
                            <label for="id_categoria" class="form-label"><i class="fas fa-tags"></i> Categoría</label>
                            <select id="id_categoria" name="id_categoria" class="form-control" required>
                                <?php foreach ($data['categorias'] as $categorias): ?>
                                    <option value="<?= $categorias['id_categoria']; ?>">
                                        <?= htmlspecialchars($categorias['tipo_categoria']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Producto</button>
                            <a href="index.php?controlador=producto&accion=index" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleExpirationDate() {
        let expirationGroup = document.getElementById('expiration-date-group');
        let perecederoYes = document.getElementById('es_perecedero-yes');

        expirationGroup.style.display = perecederoYes.checked ? "block" : "none";
    }

    document.addEventListener("DOMContentLoaded", function() {
        toggleExpirationDate();
        
        document.querySelector("form").addEventListener("submit", function(event) {
            let perecederoYes = document.getElementById("es_perecedero-yes").checked;
            let fechaCaducidad = document.getElementById("fecha_caducidad").value;

            if (perecederoYes && fechaCaducidad.trim() === "") {
                alert("Error: Como el producto es perecedero, es obligatorio ingresar la fecha de caducidad.");
                event.preventDefault();
            }
        });
    });
</script>

<?php require "views/shared/footer.php"; ?>
