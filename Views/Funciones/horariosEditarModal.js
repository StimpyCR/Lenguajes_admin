// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const id = button.getAttribute('data-id');
        const idUsuario = button.getAttribute('data-idUsuario');

        document.getElementById('editId').value = id;
        document.getElementById('editIdUsuario').value = idUsuario;
    });