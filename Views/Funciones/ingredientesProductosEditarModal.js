// Para precargar el modal de editar
const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const idIngrediente = button.getAttribute('data-idIngrediente');
        const idProducto = button.getAttribute('data-idProducto');
        const cantidad = button.getAttribute('data-cantidad');

        document.getElementById('editIdIngrediente').value = idIngrediente;
        document.getElementById('editIdProducto').value = idProducto;
        document.getElementById('editCantidad').value = cantidad;
    });