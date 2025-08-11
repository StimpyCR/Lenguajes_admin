const mesas = document.querySelectorAll('.mesa');
const inputMesa = document.getElementById('idMesa'); // ahora correcto
const btnConfirmar = document.getElementById('btnConfirmar');
const modalReserva = new bootstrap.Modal(document.getElementById('modalReserva'));

mesas.forEach(mesa => {
    mesa.addEventListener('click', () => {
        if (!mesa.classList.contains('ocupada') && !mesa.classList.contains('reservada')) {
            mesas.forEach(m => m.classList.remove('seleccionada'));
            mesa.classList.add('seleccionada');
            inputMesa.value = mesa.dataset.id;
            btnConfirmar.disabled = false; // habilitar botón
        }
    });
});

btnConfirmar.addEventListener('click', () => {
    if (inputMesa.value) {
        modalReserva.show(); // abrir modal
    }
});

// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const idMesa = button.getAttribute('data-idMesa');
        const idSucursal = button.getAttribute('data-idSucursal');
        const idEstado = button.getAttribute('data-idEstado');
        const fechaDesde = button.getAttribute('data-fechaDesde');
        const fechaHasta = button.getAttribute('data-fechaHasta');

        document.getElementById('editId').value = id;
        document.getElementById('editIdEstado').value = idEstado;
        document.getElementById('editMesa').value = idMesa;
        document.getElementById('editSucursal').value = idSucursal;
        document.getElementById('editFechaDesde').value = fechaDesde;
        document.getElementById('editFechaHasta').value = fechaHasta;
    });