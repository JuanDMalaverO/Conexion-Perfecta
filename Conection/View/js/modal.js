document.getElementById('subscriptionForm').addEventListener('submit', function(event) {
    event.preventDefault();
    if (this.checkValidity()) {
        // Si el formulario es válido, ocultamos el offcanvas y mostramos el modal
        var offcanvasRight = new bootstrap.Offcanvas(document.getElementById('offcanvasRight'));
        offcanvasRight.hide();
        var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        exampleModal.show();
    } else {
        // Si el formulario no es válido, mostramos los mensajes de validación
        this.classList.add('was-validated');
    }
});