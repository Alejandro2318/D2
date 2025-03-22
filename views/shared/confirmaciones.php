<!-- Confirmacion de eliminacion -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">ALERTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Despliega el mensaje de eliminacion -->
            </div>
            <div class="modal-footer">
                <button type="buttoncancelar" class="btn btn-secondary btncancelar" data-bs-dismiss="modal">Cancelar</button>
                <a href="#" id="confirmBtn" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</div>

<!-- Confirmación de actualización -->
<div class="modal fade" id="updateConfirmModal" tabindex="-1" aria-labelledby="updateConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateConfirmModalLabel">ALERTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Despliega el mensaje de actualización -->
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="updateConfirmBtn" class="btn btn-warning">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<!-- Eliminar elemento -->
<script>
    let deleteUrl = '';

    function confirmarEliminacion(url, tipo) {
        deleteUrl = url;
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        const mensaje = tipo === 'usuario' 
            ? '¿Estás seguro de que deseas eliminar este usuario?' 
            : '¿Estás seguro de que deseas eliminar este producto?';

        document.querySelector('#confirmModal .modal-body').innerText = mensaje;
        modal.show();
    }

    document.getElementById('confirmBtn').addEventListener('click', () => {
        window.location.href = deleteUrl;
    });

// Actualizar elemento


function updateConfirmModal(tipo) {
    const modal = new bootstrap.Modal(document.getElementById('updateConfirmModal'));
    const mensaje = tipo === 'usuario'
        ? '¿Estás seguro de que deseas actualizar este usuario?' 
        : '¿Estás seguro de que deseas actualizar este producto?';

    document.querySelector('#updateConfirmModal .modal-body').innerText = mensaje;

    // Si el usuario confirma, enviamos el formulario directamente
    document.getElementById('updateConfirmBtn').onclick = (event) => {
        event.preventDefault(); // ✅ Evitar comportamiento inesperado
        document.querySelector('form.formulario').submit(); // ✅ Enviar formulario correctamente
    };

    modal.show();
}

    
</script>

