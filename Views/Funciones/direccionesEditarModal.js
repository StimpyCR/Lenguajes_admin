// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const detalle = button.getAttribute('data-detalle');

        document.getElementById('editId').value = id;
        document.getElementById('editDetalle').value = detalle;
    });