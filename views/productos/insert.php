<?php require "views/shared/header.php" ?>

<div class="container">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>

    <form class="formulario mb-5" action="index.php?controlador=producto&accion=store" method="post">

        <div class="formulario__cont">
            <div class="formulario__cont2">
                <div class="formulario__cont-sec">
                    <label for="nombre_producto" class="form-label">Nombre producto</label>
                    <input type="text" class="formulario__cont-input form-control" id="nombre_producto" name="nombre_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label for="precio_producto" class="form-label">Precio</label>
                    <input type="number" class="formulario__cont-input form-control" id="precio_producto" name="precio_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label for="cantidad_producto" class="form-label">Cantidad</label>
                    <input type="number" class="formulario__cont-input form-control" id="cantidad_producto" name="cantidad_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label class="form-label">¿Es perecedero?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-yes" value="1" onchange="toggleExpirationDate()">
                        <label class="form-check-label" for="es_perecedero-yes">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-no" value="0" checked onchange="toggleExpirationDate()">
                        <label class="form-check-label" for="es_perecedero-no">No</label>
                    </div>
                </div>

                <!-- Campo de Fecha de Caducidad (inicialmente oculto) -->
                <div class="formulario__cont-sec" id="expiration-date-group" style="display: none;">
                    <label for="fecha_caducidad" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="formulario__cont-input form-control" id="fecha_caducidad" name="fecha_caducidad">
                </div>

                <!-- JavaScript para mostrar/ocultar la fecha -->
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
                                event.preventDefault(); // Evita el envío del formulario
                            }
                        });
                    });
                </script>

                <div class="formulario__cont-sec">
                    <label for="id_categoria" class="form-label">Categoria</label>
                    <select id="id_categoria" name="id_categoria" class="form-control" required>
                        <?php foreach ($data['categorias'] as $categorias): ?>
                            <option value="<?= $categorias['id_categoria']; ?>">
                                <?= htmlspecialchars($categorias['tipo_categoria']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>