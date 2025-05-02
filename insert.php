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



 <!-- Alerta stock bajo -->
<?php
if (isset($_SESSION['stockInsuficiente'])) {
    $producto = $_SESSION['stockInsuficiente']['producto'];
    $disponible = $_SESSION['stockInsuficiente']['disponible'];

    echo '
        <div id="custom-alert-overlay">
            <div id="custom-alert-box">
                <h5 class="custom-alert-title">Stock insuficiente</h5>
                <p>No hay suficiente stock para el producto <strong>' . $producto . '</strong>. Stock disponible: ' . $disponible . '</p>
                <button class="botonCerrar" id="close-venta">Cerrar</button>
            </div>
        </div>
    ';

    unset($_SESSION['stockInsuficiente']);
}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<div class="containerP">
    <h1 class="text-center my-5"><?= $data['titulo'] ?></h1>
    
    <form class="formulario mb-5" action="index.php?controlador=factura&accion=store" method="post">
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

        <!-- Productos dinámicos -->
        <div class="formulario__cont">
            <div id="productos">
                <!-- Primer producto -->
                <div class="formulario__cont" id="producto_0_container">
                    <div class="formulario__cont2 w100">
                        <div class="formulario__cont-sec w100">
                            <label for="producto_0" class="form-label">Producto</label>
                            <select id="producto_0" name="productos[0][id_producto]" class="form-select w-100 selectDos" required>
                                <option value="" disabled selected>-- Seleccione --</option>
                                <?php foreach ($data['productos'] as $item) { ?>
                                    <option value="<?= $item['id_producto'] ?>" 
                                            data-precio="<?= number_format($item['precio_producto'], 2, '.', '') ?>">
                                        <?= $item['nombre_producto'] ?> (Stock: <?= $item['cantidad_producto'] ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="formulario__cont2 w100">
                        <div class="formulario__cont-sec w100">
                            <label for="cantidad_0" class="form-label">Cantidad</label>
                            <input type="number" id="cantidad_0" name="productos[0][cantidad]" class="form-control" min="1" required>
                        </div>
                    </div>
                    
                    <div class="formulario__cont2 w100">
                        <div class="formulario__cont-sec w100">
                            <label for="precio_unitario_0" class="form-label">Precio Unitario</label>
                            <input type="text" id="precio_unitario_0" name="productos[0][precio_unitario]" class="form-control" readonly>
                        </div>
                    </div>
                    
                    <div class="formulario__cont2 w100">
                        <div class="formulario__cont-sec w100">
                            <label for="subtotal_0" class="form-label">Subtotal</label>
                            <input type="text" id="subtotal_0" name="productos[0][subtotal]" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            
            <button type="button" id="agregar-producto" class="btnform btn-primary venta mt-3">Agregar Producto</button>
        </div>

        <!-- Total -->
        <div class="formulario__cont2 w100 mt-4">
            <div class="formulario__cont-sec w100">
                <label for="total" class="form-label">Total</label>
                <input type="text" id="total" name="total_factura" class="form-control" readonly value="0.00">
            </div>
        </div>
        
        <button type="submit" class="btnform btn-primary venta mt-4">Vender</button>
    </form>
</div>

<?php require "views/shared/footer.php" ?>

<!-- Incluir Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let productoCount = 1;
    const productosContainer = document.getElementById('productos');
    const agregarProductoBtn = document.getElementById('agregar-producto');
    const totalInput = document.getElementById('total');

    // Inicializar Select2 para el primer producto
    $('#producto_0').select2();

    // Configurar eventos para el primer producto
    setupProductoEvents(document.getElementById('producto_0_container'));

    // Agregar nuevo producto
    agregarProductoBtn.addEventListener('click', function() {
        const nuevoProducto = document.createElement('div');
        nuevoProducto.className = 'formulario__cont mt-3';
        nuevoProducto.id = `producto_${productoCount}_container`;
        nuevoProducto.innerHTML = `
            <div class="formulario__cont2 w100">
                <div class="formulario__cont-sec w100">
                    <label for="producto_${productoCount}" class="form-label">Producto</label>
                    <select id="producto_${productoCount}" name="productos[${productoCount}][id_producto]" class="form-select w-100 selectDos" required>
                        <option value="" disabled selected>-- Seleccione --</option>
                        <?php foreach ($data['productos'] as $item) { ?>
                            <option value="<?= $item['id_producto'] ?>" 
                                    data-precio="<?= number_format($item['precio_producto'], 2, '.', '') ?>">
                                <?= $item['nombre_producto'] ?> (Stock: <?= $item['cantidad_producto'] ?>)
                            </option>
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
                    <input type="text" id="precio_unitario_${productoCount}" name="productos[${productoCount}][precio_unitario]" class="form-control" readonly>
                </div>
            </div>
            
            <div class="formulario__cont2 w100">
                <div class="formulario__cont-sec w100">
                    <label for="subtotal_${productoCount}" class="form-label">Subtotal</label>
                    <input type="text" id="subtotal_${productoCount}" name="productos[${productoCount}][subtotal]" class="form-control" readonly>
                </div>
            </div>
            
            <button type="button" class="btn btn-danger btn-sm mt-2 eliminar-producto">Eliminar</button>
        `;
        
        productosContainer.appendChild(nuevoProducto);
        
        // Inicializar Select2 para el nuevo select
        $(`#producto_${productoCount}`).select2();
        
        // Configurar eventos para el nuevo producto
        setupProductoEvents(nuevoProducto);
        productoCount++;
    });

    // Configurar eventos para un producto
    function setupProductoEvents(productoElement) {
        const select = productoElement.querySelector('select');
        const cantidadInput = productoElement.querySelector('input[type="number"]');
        const precioInput = productoElement.querySelector('input[name*="precio_unitario"]');
        const subtotalInput = productoElement.querySelector('input[name*="subtotal"]');
        const eliminarBtn = productoElement.querySelector('.eliminar-producto');

        // Evento para cambio de producto (usando jQuery para Select2)
        $(select).on('change', function() {
            const precio = parseFloat($(this).find(':selected').data('precio')) || 0;
            precioInput.value = precio.toFixed(2);
            calcularSubtotal(cantidadInput, precioInput, subtotalInput);
            calcularTotal();
        });

        // Evento para cambio de cantidad
        cantidadInput.addEventListener('input', function() {
            calcularSubtotal(cantidadInput, precioInput, subtotalInput);
            calcularTotal();
        });

        // Evento para eliminar producto
        if(eliminarBtn) {
            eliminarBtn.addEventListener('click', function() {
                productoElement.remove();
                calcularTotal();
            });
        }
    }

    // Calcular subtotal para un producto
    function calcularSubtotal(cantidadInput, precioInput, subtotalInput) {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const precio = parseFloat(precioInput.value) || 0;
        subtotalInput.value = (cantidad * precio).toFixed(2);
    }

    // Calcular total de la factura
    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('input[name*="subtotal"]').forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        totalInput.value = total.toFixed(2);
    }
});
</script>