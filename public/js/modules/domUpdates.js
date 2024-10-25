export function domUpdates(etiqueta, message, type) {
    const mensajeDiv = document.getElementById(`${etiqueta}`);
    mensajeDiv.innerHTML = `<div class="alert alert-${type} alert-dismissible my-2">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>${message}
                            </div>`;
}