<?php require "views/shared/header.php" ?>

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
            <div class="formulario__cont-sec">
                <label for="id_usuario" class="form-label">Cajero</label>
                <select id="id_usuario" name="id_usuario" class="form-select w-100 formulario__cont-select"
                    aria-label="Default select example">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <?php foreach ($data['usuarios'] as $item) { ?>
                        <option value="<?= $item['id_usuario'] ?>"><?= $item['nombre_usuario'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="formulario__cont">
                <div id="productos">
                    <!-- Productos se agregarán dinámicamente aquí -->
                </div>
            </div>
            <button type="button" class="btnform btn-primary" id="agregarProducto">Agregar Producto</button>

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

        <button type="submit" class="btnform btn-primary">Vender</button>
</div>

<!-- Detalle de la venta -->

</form>
</div>

<?php require "views/shared/footer.php" ?>



<!-- JS para implentra mas adelante en su respectiva carpeta-->

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const productosContainer = document.getElementById('productos');
        const agregarProductoButton = document.getElementById('agregarProducto');
        const totalInput = document.getElementById('total_factura');

        let productoCount = 0;

        function calculateTotal() {
            const productosDivs = document.querySelectorAll('#productos > .formulario__cont');
            let total_factura = 0;

            productosDivs.forEach(div => {
                const inputSubtotal = div.querySelector('input[type="number"][name*="subtotal"]');
                if (inputSubtotal) {
                    total_factura += parseFloat(inputSubtotal.value) || 0;
                }
            });

            totalInput.value = total_factura.toFixed(2);
            console.log('Total Calculado:', total_factura); // Debugging: Imprime el total_factura en la consola
        }

        function validateForm() {
            const productosDivs = document.querySelectorAll('#productos > .formulario__cont');
            let allValid = true;

            productosDivs.forEach(div => {
                const selectProducto = div.querySelector('select');
                const inputCantidad = div.querySelector('input[type="number"]');
                const precioUnitario = div.querySelector('input[name*="precio_unitario"]');

                if (!selectProducto.value || !inputCantidad.value || !precioUnitario.value) {
                    allValid = false;
                }
            });

            agregarProductoButton.disabled = !allValid;
        }

        function disablePreviousFields(currentIndex) {
            const productosDivs = document.querySelectorAll('#productos > .formulario__cont');

            productosDivs.forEach((div, index) => {
                if (index < currentIndex) {
                    const selectProducto = div.querySelector('select');
                    const inputCantidad = div.querySelector('input[type="number"]');

                    if (selectProducto) {
                        selectProducto.style.backgroundColor = '#e9ecef';
                        selectProducto.style.color = '#6c757d';
                        selectProducto.style.cursor = 'not-allowed';
                        selectProducto.setAttribute('disabled', 'true');
                    }
                    if (inputCantidad) inputCantidad.setAttribute('readonly', true);
                }
            });
        }

        agregarProductoButton.addEventListener('click', () => {
            productoCount++;

            const productoDiv = document.createElement('div');
            productoDiv.classList.add('formulario__cont');
            productoDiv.innerHTML = `
   <div class="formulario__cont2 w100">
<div class="formulario__cont-sec w100">
    <label for="producto_${productoCount}" class="form-label">Producto</label>
    <select id="producto_${productoCount}" name="productos[${productoCount}][id_producto]" class="form-select w-50 formulario__cont-select" aria-label="Default select example">
        <option value="" disabled selected>-- Seleccione --</option>
        <?php foreach ($data['productos'] as $item) { ?>
            <option value="<?= $item['id_producto'] ?>" data-precio="<?= $item['precio_producto'] ?>"><?= $item['nombre_producto'] ?> (Stock: <?= $item['cantidad_producto'] ?>)</option>
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
            <label for="precio_unitario_${productoCount}" class="form-label">Precio Uni</label>
            <input type="number" id="precio_unitario_${productoCount}" name="productos[${productoCount}][precio_unitario]" class="form-control" step="0.01" min="0" required readonly>
        </div>
    </div>

    <div class="formulario__cont2 w100">
        <div class="formulario__cont-sec w100">
            <label for="subtotal_${productoCount}" class="form-label">Subtotal</label>
            <input type="number" id="subtotal_${productoCount}" name="productos[${productoCount}][subtotal]" class="form-control" step="0.01" min="0" required readonly>
        </div>
    </div>
    `;

            productosContainer.appendChild(productoDiv);

            // Habilitar el botón de agregar producto solo después de agregar el primer producto
            if (productoCount > 0) {
                agregarProductoButton.disabled = false;
            }

            // Deshabilitar los campos del producto anterior
            disablePreviousFields(productoCount - 1);

            // Agregar un event listener para el cambio en el select
            const selectProducto = document.getElementById(`producto_${productoCount}`);
            selectProducto.addEventListener('change', () => {
                const selectedOption = selectProducto.options[selectProducto.selectedIndex];
                const precio = selectedOption.getAttribute('data-precio');
                document.getElementById(`precio_unitario_${productoCount}`).value = precio;
                calculateTotal(); // Actualizar el total_factura
                validateForm(); // Verificar si se puede habilitar el botón
            });

            // Agregar un event listener para actualizar el subtotal cuando la cantidad cambie
            const inputCantidad = document.getElementById(`cantidad_${productoCount}`);
            inputCantidad.addEventListener('input', () => {
                const precioUnitario = document.getElementById(`precio_unitario_${productoCount}`).value;
                const cantidad = inputCantidad.value;
                document.getElementById(`subtotal_${productoCount}`).value = precioUnitario * cantidad;
                calculateTotal(); // Actualizar el total_factura
                validateForm(); // Verificar si se puede habilitar el botón
            });

            // Inicialmente validar el estado del botón y calcular el total_factura
            validateForm();
            calculateTotal();
        });

        // Habilitar el botón de agregar producto para el primer producto
        agregarProductoButton.disabled = false;

        // Asegúrate de recalcular el total_factura cuando el formulario se envíe
        document.querySelector('form').addEventListener('submit', () => {
            calculateTotal();
        });
    });

</script>