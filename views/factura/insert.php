<?php require "views/shared/header.php" ?>

<div class="container-vender">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    <link rel="stylesheet" href="styles/styles.css">
    

    <form class="formulario mb-5" action="index.php?controlador=factura&accion=store" method="post">
        
            <div class="formulario__cont2">
                <div class="formulario__cont-sec">
                    <label for="id_usuario" class="form-label">Cajero</label>
                    <select id="id_usuario" name="id_usuario" class="form-select w-100 formulario__cont-select" aria-label="Default select example">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($data['usuarios'] as $item) { ?>
                            <option value="<?= $item['id_usuario'] ?>"><?= $item['nombre_usuario'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Detalle de la venta -->
        <div class="formulario__cont">
            <div id="productos">
                <!-- Productos se agregarán dinámicamente aquí -->
            </div>
        </div>
        <button type="button" class="btn btn-secondary" id="agregarProducto">Agregar Producto</button>

        <!-- Total -->
        <div class="formulario__cont">
            <div class="formulario__cont2 w100">
                <div class="formulario__cont-sec w100">
                    <label for="total_factura" class="form-label">Total</label>
                    <input type="number" id="total_factura" name="total_factura" class="form-control" min="0" required readonly>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Vender</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>

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
