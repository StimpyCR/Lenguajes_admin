// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');

        document.getElementById('editId').value = id;
    });