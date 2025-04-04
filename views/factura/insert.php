<?php require "views/shared/header.php" ?>
<?php if (isset($_SESSION['cajaCerrada']) && $_SESSION['cajaCerrada']){

echo '
    <div id="custom-alert-overlay">
        <div id="custom-alert-box">
            <h5 class="custom-alert-title">Caja cerrada</h5>
            <p>Debes abrir la caja para poder realizar una venta</p>
            <button class="botonCerrar" id="close">Cerrar</button>
        </div>
    </div>
';
exit;
}
?>

<div class="containerP">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <div class="iconoP">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" id="Card--Streamline-Ionic-Filled"
            height="48" width="48">
            <desc>Card Streamline Icon: https://streamlinehq.com</desc>
            <path fill="#ffffff"
                d="M0.48 36.5996c0 1.5594 0.6195 3.055 1.7222 4.1577 1.1027 1.1028 2.5983 1.7222 4.1578 1.7222h35.28c1.5594 0 3.0551 -0.6194 4.1578 -1.7222 1.1027 -1.1027 1.7222 -2.5983 1.7222 -4.1577v-16.17H0.48v16.17Zm6.93 -7.98c0 -0.8354 0.3319 -1.6367 0.9226 -2.2274 0.5908 -0.5908 1.3921 -0.9227 2.2274 -0.9227h5.04c0.8353 0 1.6366 0.3319 2.2274 0.9227 0.5907 0.5907 0.9226 1.392 0.9226 2.2274v2.0999c0 0.8354 -0.3319 1.6367 -0.9226 2.2274 -0.5908 0.5908 -1.3921 0.9226 -2.2274 0.9226h-5.04c-0.8353 0 -1.6366 -0.3318 -2.2274 -0.9226 -0.5907 -0.5907 -0.9226 -1.392 -0.9226 -2.2274v-2.0999Z"
                stroke-width="1"></path>
            <path fill="#ffffff"
                d="M41.64 5.5205H6.36c-1.5595 0 -3.0551 0.6195 -4.1578 1.7222S0.48 9.841 0.48 11.4005v2.7299h47.04v-2.7299c0 -1.5595 -0.6195 -3.0551 -1.7222 -4.1578S43.1994 5.5205 41.64 5.5205Z"
                stroke-width="1"></path>
        </svg>
    </div>
    <form class="formulario mb-5" action="index.php?controlador=factura&accion=store" method="post">
        <div class="formulario__cont2">
            <!-- Cajero -->
            <div class="formulario__cont-sec">
                <label for="id_usuario" class="form-label">Cajero</label>
                <select id="id_usuario" name="id_usuario" class="form-select w-100 formulario__cont-select" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php foreach ($data['usuarios'] as $item) { ?>
                        <option value="<?= $item['id_usuario'] ?>"><?= $item['nombre_usuario'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- Productos -->
            <div class="formulario__cont">
                <div id="productos">
                    <!-- Productos se agregarán dinámicamente aquí -->
                </div>
            </div>

            <!-- Botón para agregar productos -->
            <button type="button" class="btnform btn-primary venta" id="agregarProducto">Agregar Producto</button>

            <!-- Total -->
            <div class="formulario__cont">
                <div class="formulario__cont2 w100">
                    <div class="formulario__cont-sec w100">
                        <label for="total_factura" class="form-label">Total</label>
                        <input type="number" id="total_factura" name="total_factura" class="form-control" min="0"
                            required readonly>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btnform btn-primary venta">Vender</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>

<!-- ✅ SCRIPT COMPLETO -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productosContainer = document.getElementById('productos');
        const agregarProductoButton = document.getElementById('agregarProducto');
        const totalInput = document.getElementById('total_factura');

        let productoCount = 0;

        // 🔥 Función para calcular el total
        function calculateTotal() {
            let total_factura = 0;
            document.querySelectorAll('#productos > .formulario__cont').forEach(div => {
                const inputSubtotal = div.querySelector('input[name*="subtotal"]');
                if (inputSubtotal) {
                    total_factura += parseFloat(inputSubtotal.value) || 0;
                }
            });
            totalInput.value = total_factura.toFixed(2);
        }

        // 🔥 Validación del formulario
        function validateForm() {
            let allValid = true;
            document.querySelectorAll('#productos > .formulario__cont').forEach(div => {
                const selectProducto = div.querySelector('select');
                const inputCantidad = div.querySelector('input[type="number"]');
                const precioUnitario = div.querySelector('input[name*="precio_unitario"]');

                if (!selectProducto.value || !inputCantidad.value || !precioUnitario.value) {
                    allValid = false;
                }
            });

            agregarProductoButton.disabled = !allValid;
        }

        // ✅ Agregar nuevo producto
        agregarProductoButton.addEventListener('click', () => {
            const productoDiv = document.createElement('div');
            productoDiv.classList.add('formulario__cont');
            productoDiv.innerHTML = `
                <div class="formulario__cont2 w100">
                    <div class="formulario__cont-sec w100">
                        <label for="producto_${productoCount}" class="form-label">Producto</label>
                        <select id="producto_${productoCount}" name="productos[${productoCount}][id_producto]" class="form-select w-50 formulario__cont-select" required>
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php foreach ($data['productos'] as $item) { ?>
                                <option value="<?= $item['id_producto'] ?>" data-precio="<?= floatval($item['precio_producto']) ?>"><?= $item['nombre_producto'] ?> (Stock: <?= $item['cantidad_producto'] ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="formulario__cont2 w100">
                    <div class="formulario__cont-sec w100">
                        <label for="cantidad_${productoCount}" class="form-label">Cantidad</label>
                        <input type="number" id="cantidad_${productoCount}" name="productos[${productoCount}][cantidad]" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="formulario__cont2 w100">
                    <div class="formulario__cont-sec w100">
                        <label for="precio_unitario_${productoCount}" class="form-label">Precio Unitario</label>
                        <input type="number" id="precio_unitario_${productoCount}" name="productos[${productoCount}][precio_unitario]" class="form-control" step="0.01" required readonly>
                    </div>
                </div>

                <div class="formulario__cont2 w100">
                    <div class="formulario__cont-sec w100">
                        <label for="subtotal_${productoCount}" class="form-label">Subtotal</label>
                        <input type="number" id="subtotal_${productoCount}" name="productos[${productoCount}][subtotal]" class="form-control" step="0.01" required readonly>
                    </div>
                </div>
            `;

            productosContainer.appendChild(productoDiv);

            const selectProducto = document.getElementById(`producto_${productoCount}`);
            const inputCantidad = document.getElementById(`cantidad_${productoCount}`);
            const precioUnitario = document.getElementById(`precio_unitario_${productoCount}`);
            const subtotal = document.getElementById(`subtotal_${productoCount}`);

            // ✅ Asignar precio unitario automáticamente
            selectProducto.addEventListener('change', () => {
                const precio = parseFloat(selectProducto.options[selectProducto.selectedIndex].getAttribute('data-precio')) || 0;
                precioUnitario.value = precio.toFixed(2);

                if (inputCantidad.value) {
                    subtotal.value = (inputCantidad.value * precio).toFixed(2);
                }

                calculateTotal();
                validateForm();
            });

            // ✅ Calcular subtotal cuando se cambia la cantidad
            inputCantidad.addEventListener('input', () => {
                const precio = parseFloat(precioUnitario.value) || 0;
                subtotal.value = (inputCantidad.value * precio).toFixed(2);

                calculateTotal();
                validateForm();
            });

            productoCount++;
            validateForm();
            calculateTotal();
        });

        // ✅ Calcular total al enviar formulario
        document.querySelector('form').addEventListener('submit', () => {
            calculateTotal();
        });
    });
</script>