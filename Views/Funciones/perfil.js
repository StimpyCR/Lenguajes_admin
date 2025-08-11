// Confirmación para asegurarse de que el usuario desea inactivar la cuenta
document.getElementById('btnEliminarPerfilUsuario').addEventListener('click', function(e) {
    if (!confirm('¿Estás seguro de que deseas inactivar tu cuenta?')) {
        e.preventDefault();
    }
});