// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const numeroMesa = button.getAttribute('data-numeroMesa');
        const ubicacion = button.getAttribute('data-ubicacion');
        const capacidad = button.getAttribute('data-capacidad');

        document.getElementById('editId').value = id;
        document.getElementById('editNumeroMesa').value = numeroMesa;
        document.getElementById('editUbicacion').value = ubicacion;
        document.getElementById('editCapacidad').value = capacidad;
    });