
<?php require "views/shared/header.php" ?>

<div class="containerP">
    <h1 class="text-center my-5">
        <?= $data['titulo'] ?>
    </h1>
    <!-- icono del producto -->

    <div class="iconoP">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" id="Cart--Streamline-Ionic-Filled"
            height="48" width="48">
            <desc>Cart Streamline Icon: https://streamlinehq.com</desc>
            <path fill="#ffffff"
                d="M16.2233 44.9917c1.932 0 3.4982 -1.5663 3.4982 -3.4983s-1.5662 -3.4983 -3.4982 -3.4983c-1.932 0 -3.4984 1.5662 -3.4984 3.4983 0 1.932 1.5664 3.4983 3.4984 3.4983Z"
                stroke-width="1"></path>
            <path fill="#ffffff"
                d="M40.7143 44.9917c1.932 0 3.4983 -1.5663 3.4983 -3.4983s-1.5663 -3.4983 -3.4983 -3.4983 -3.4982 1.5662 -3.4982 3.4983c0 1.932 1.5662 3.4983 3.4982 3.4983Z"
                stroke-width="1"></path>
            <path fill="#ffffff"
                d="M46.9228 9.2159c-0.2458 -0.3006 -0.5554 -0.5426 -0.9063 -0.7086 -0.3509 -0.166 -0.7346 -0.2518 -1.1228 -0.2512H11.6195l-0.6702 -3.8025c-0.0715 -0.405 -0.2834 -0.7719 -0.5985 -1.0362 -0.3151 -0.2643 -0.7132 -0.4092 -1.1245 -0.4091h-6.997c-0.464 0 -0.9089 0.1843 -1.237 0.5124S0.48 4.2936 0.48 4.7576c0 0.4639 0.1843 0.9088 0.5123 1.2369 0.3281 0.328 0.773 0.5123 1.237 0.5123h5.5298l4.992 28.2922c0.0715 0.405 0.2834 0.7719 0.5985 1.0361 0.315 0.2644 0.7132 0.4092 1.1245 0.4091h27.9881c0.4639 0 0.9089 -0.1842 1.237 -0.5123s0.5123 -0.7731 0.5123 -1.237c0 -0.4638 -0.1843 -0.9088 -0.5123 -1.2368s-0.7731 -0.5123 -1.237 -0.5123H15.9413l-0.6167 -3.4986h26.4205c0.6066 -0.0008 1.1944 -0.2111 1.6637 -0.5955 0.4693 -0.3842 0.7916 -0.9189 0.912 -1.5134l3.1486 -15.7433c0.0759 -0.3812 0.0663 -0.7743 -0.0282 -1.151 -0.0946 -0.3769 -0.2716 -0.7279 -0.5184 -1.0281Z"
                stroke-width="1"></path>
        </svg>
    </div>


    <form class="formulario mb-5" action="index.php?controlador=producto&accion=store" method="post">

        <div class="formulario__cont">
            <div class="formulario__cont2">
                <div class="formulario__cont-sec">
                    <label for="nombre_producto" class="form-label">Nombre producto</label>
                    <input type="text" class="formulario__cont-input form-control" id="nombre_producto"
                        name="nombre_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label for="precio_producto" class="form-label">Precio</label>
                    <input type="number" class="formulario__cont-input form-control" id="precio_producto"
                        name="precio_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label for="cantidad_producto" class="form-label">Cantidad</label>
                    <input type="number" class="formulario__cont-input form-control" id="cantidad_producto"
                        name="cantidad_producto" required>
                </div>
                <div class="formulario__cont-sec">
                    <label class="form-label">¿Es perecedero?</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-yes"
                            value="1" onchange="toggleExpirationDate()">
                        <label class="form-check-label" for="es_perecedero-yes">Sí</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="es_perecedero" id="es_perecedero-no"
                            value="0" checked onchange="toggleExpirationDate()">
                        <label class="form-check-label" for="es_perecedero-no">No</label>
                    </div>
                </div>

                <!-- Campo de Fecha de Caducidad (inicialmente oculto) -->
                <div class="formulario__cont-sec" id="expiration-date-group" style="display: none;">
                    <label for="fecha_caducidad" class="form-label">Fecha de Vencimiento</label>
                    <input type="date" class="formulario__cont-input form-control" id="fecha_caducidad"
                        name="fecha_caducidad">
                </div>

                <!-- JavaScript para mostrar/ocultar la fecha -->
                <script>
                    function toggleExpirationDate() {
                        let expirationGroup = document.getElementById('expiration-date-group');
                        let perecederoYes = document.getElementById('es_perecedero-yes');

                        expirationGroup.style.display = perecederoYes.checked ? "block" : "none";
                    }

                    document.addEventListener("DOMContentLoaded", function () {
                        toggleExpirationDate();

                        document.querySelector("form").addEventListener("submit", function (event) {
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