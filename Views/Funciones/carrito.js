document.addEventListener('DOMContentLoaded', () => {
    const btnEditar = document.getElementById('btnEditarCarrito');
    const cardFooter = btnEditar.parentElement; // contenedor de botones

    let btnConfirmar = null;
    let btnCancelar = null;
    let editing = false;

    // Guardamos valores originales para cancelar
    let valoresOriginales = [];

    btnEditar.addEventListener('click', () => {
        if (editing) return; // evitar doble click
        editing = true;

        // Guardar valores actuales para poder restaurar si cancela
        valoresOriginales = [];
        document.querySelectorAll('#cartItems tr').forEach((row, i) => {
            const spanCantidad = row.querySelector('.cantidad-text');
            valoresOriginales[i] = spanCantidad.textContent;
            // Mostrar input, ocultar texto
            spanCantidad.classList.add('d-none');
            const input = row.querySelector('.cantidad-input');
            input.classList.remove('d-none');
            input.value = valoresOriginales[i];
        });

        // Crear botones confirmar y cancelar si no existen
        if (!btnConfirmar) {
            btnConfirmar = document.createElement('button');
            btnConfirmar.type = 'submit';
            btnConfirmar.name = 'accion';
            btnConfirmar.value = 'confirmarEdicion';
            btnConfirmar.textContent = 'Confirmar cambios';
            btnConfirmar.classList.add('btn', 'btn-success');
            btnConfirmar.style.marginLeft = '10px';

            btnCancelar = document.createElement('button');
            btnCancelar.type = 'button';
            btnCancelar.textContent = 'Cancelar';
            btnCancelar.classList.add('btn', 'btn-secondary');
            btnCancelar.style.marginLeft = '10px';

            cardFooter.appendChild(btnConfirmar);
            cardFooter.appendChild(btnCancelar);

            // Evento cancelar
            btnCancelar.addEventListener('click', () => {
                editing = false;

                document.querySelectorAll('#cartItems tr').forEach((row, i) => {
                    const spanCantidad = row.querySelector('.cantidad-text');
                    const input = row.querySelector('.cantidad-input');
                    // Restaurar valores originales
                    spanCantidad.textContent = valoresOriginales[i];
                    spanCantidad.classList.remove('d-none');
                    input.classList.add('d-none');
                });

                btnConfirmar.remove();
                btnCancelar.remove();
                btnConfirmar = null;
                btnCancelar = null;

                btnEditar.disabled = false;
            });

            // Evento confirmar
            btnConfirmar.addEventListener('click', () => {
                editing = false;

                document.querySelectorAll('#cartItems tr').forEach(row => {
                    const spanCantidad = row.querySelector('.cantidad-text');
                    const input = row.querySelector('.cantidad-input');
                    // Actualizar texto con valor input
                    spanCantidad.textContent = input.value;
                    spanCantidad.classList.remove('d-none');
                    input.classList.add('d-none');
                });

                document.getElementById('cartForm').submit();
            });
        }

        btnEditar.disabled = true;
    });

    document.addEventListener('click', e => {
        if (e.target.closest('.remove-item')) {
            if (!confirm('¿Seguro que quieres remover este producto del carrito?')) return;

            const row = e.target.closest('tr');
            const idCarrito = row.querySelector('input[name="idCarrito[]"]').value;
            const idProducto = row.querySelector('input[name="idProducto[]"]').value;

            // Crear formulario dinámico para enviar POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/LENGUAJES_ADMIN/index.php?controller=carrito&action=enrutadorAccion';

            // input accion
            const accionInput = document.createElement('input');
            accionInput.type = 'hidden';
            accionInput.name = 'accion';
            accionInput.value = 'eliminar';
            form.appendChild(accionInput);

            // input idCarrito[]
            const idCarritoInput = document.createElement('input');
            idCarritoInput.type = 'hidden';
            idCarritoInput.name = 'idCarrito[]';
            idCarritoInput.value = idCarrito;
            form.appendChild(idCarritoInput);

            // input idProducto[]
            const idProductoInput = document.createElement('input');
            idProductoInput.type = 'hidden';
            idProductoInput.name = 'idProducto[]';
            idProductoInput.value = idProducto;
            form.appendChild(idProductoInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
});
