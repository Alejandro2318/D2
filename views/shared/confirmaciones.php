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

<!-- Modal para acceso denegado -->
<div class="modal fade" id="accessDeniedModal" tabindex="-1" aria-labelledby="accessDeniedModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="accessDeniedModalLabel">Acceso Denegado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Solo los administradores pueden agregar nuevos productos.
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
