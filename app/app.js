document.addEventListener("DOMContentLoaded", () => {
    const closeBtn = document.getElementById("close-alert-btn");
    const overlay = document.getElementById("custom-alert-overlay");

    if (closeBtn && overlay) {
        // Redirigir usando una ruta relativa desde la raíz
        closeBtn.addEventListener("click", () => {
            window.location.href = "index.php?controlador=usuario&accion=index";
        });

    }
});

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


document.addEventListener('DOMContentLoaded', () => {
    const confirmBtn = document.getElementById('confirmBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', () => {
            window.location.href = deleteUrl;
        });
    }
});

function updateConfirmModal(tipo) {
    const modal = new bootstrap.Modal(document.getElementById('updateConfirmModal'));
    const mensaje = tipo === 'usuario'
        ? '¿Estás seguro de que deseas actualizar este usuario?'
        : '¿Estás seguro de que deseas actualizar este producto?';

    document.querySelector('#updateConfirmModal .modal-body').innerText = mensaje;

    const updateConfirmBtn = document.getElementById('updateConfirmBtn');
    if (updateConfirmBtn) {
        updateConfirmBtn.onclick = (event) => {
            event.preventDefault();
            document.querySelector('form.formulario').submit();
        };
    }

    modal.show();
}

// Botones para abrir y cerrar caja 
document.addEventListener("DOMContentLoaded", function () {
    const botones = document.querySelectorAll(".actualizarEstado");

    botones.forEach(boton => {
        boton.addEventListener("click", function (e) {
            e.preventDefault();
            
            let estado = this.getAttribute("data-estado");
            
            // Enviar la solicitud AJAX con fetch
            fetch("index.php?controlador=caja&accion=actualizarEstado", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `estado=${estado}`
            })
            .then(response => {
                // Recargar la página para reflejar el cambio
                window.location.reload();
            })
            .catch(error => {
                console.error("Error:", error);
                // Recargar la página incluso si hay un error
                window.location.reload();
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    let closeAlertBtn = document.getElementById("close");
    if (closeAlertBtn) {
        closeAlertBtn.addEventListener("click", function() {
            window.location.href = "index.php?controlador=caja&accion=index";
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    if (!Array.isArray(alertasStock) || alertasStock.length === 0) return;

    let index = 0;

    function mostrarSiguienteAlerta() {
        if (index < alertasStock.length) {
            const producto = alertasStock[index];

            const overlay = document.createElement("div");
            overlay.id = "custom-alert-overlay";
            overlay.innerHTML = `
                <div id="custom-alert-box">
                    <h5 class="custom-alert-title">¡Stock bajo!</h5>
                    <p>El producto ${producto.nombre} tiene solo ${producto.cantidad} unidades.</p>
                    <button class="botonCerrar">Cerrar</button>
                </div>
            `;

            document.body.appendChild(overlay);

            const botonCerrar = overlay.querySelector(".botonCerrar");
            botonCerrar.addEventListener("click", () => {
                document.body.removeChild(overlay);
                index++;
                setTimeout(mostrarSiguienteAlerta, 300);
            });
        }
    }

    mostrarSiguienteAlerta();
});

// Agregue esta funcion para el boton de la factura para que me mantenga en el insert

document.addEventListener("DOMContentLoaded", function() {
    let closeAlertBtn = document.getElementById("close-venta");
    if (closeAlertBtn) {
        closeAlertBtn.addEventListener("click", function() {
            window.location.href = "index.php?controlador=factura&accion=insert";
        });
    }
});


// alerta caducidad*****************
document.addEventListener("DOMContentLoaded", function () {
    if (!Array.isArray(alertasCaducidad) || alertasCaducidad.length === 0) return;

    let indexCad = 0;

    function mostrarSiguienteCaducidad() {
        if (indexCad < alertasCaducidad.length) {
            const producto = alertasCaducidad[indexCad];

            const overlay = document.createElement("div");
            overlay.id = "custom-alert-overlay";
            overlay.innerHTML = `
                <div id="custom-alert-box">
                    <h5 class="custom-alert-title">⚠️ ¡Producto por caducar!</h5>
                    <p>El producto <strong>${producto.nombre}</strong> vence el <strong>${producto.fecha.substring(0, 10)}</strong>.</p>
                    <button class="botonCerrar">Cerrar</button>
                </div>
            `;

            document.body.appendChild(overlay);

            const botonCerrar = overlay.querySelector(".botonCerrar");
            botonCerrar.addEventListener("click", () => {
                document.body.removeChild(overlay);
                indexCad++;
                setTimeout(mostrarSiguienteCaducidad, 300);
            });
        }
    }

    mostrarSiguienteCaducidad();
});

