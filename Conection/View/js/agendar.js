document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('appointmentForm');

    form.addEventListener('submit', (e) => {
        const tipoMesa = form.tipoMesa.value;
        const fecha = form.fecha.value;
        const fechaHoraInicio = form.fechaHoraInicio.value;
        const horas = form.horas.value;
        const cantidadJugadores = form.cantidadJugadores.value;

        const currentDate = new Date();
        const selectedDate = new Date(fecha);

        if (!tipoMesa || !fecha || !fechaHoraInicio || !horas || !cantidadJugadores) {
            e.preventDefault();
            alert('Por favor, complete todos los campos.');
        } else if (selectedDate < currentDate) {
            e.preventDefault();
            alert('La fecha seleccionada no puede ser anterior a la fecha actual.');
        } else if (cantidadJugadores < 1 || cantidadJugadores > 10) {
            e.preventDefault();
            alert('El número de jugadores debe estar entre 1 y 10.');
        }
    });
});
