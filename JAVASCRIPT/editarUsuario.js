function editarUsuario() {
    document.getElementById('usuario-view').style.display = 'none';
    document.getElementById('usuario-edit').style.display = 'inline';
    document.getElementById('editar-usuario').style.display = 'none';
    document.getElementById('salvar-usuario').style.display = 'inline';
}
function salvarUsuario() {
    var novoEmail = document.getElementById('email-edit').value;
    document.getElementById('usuario-view').textContent = novoEmail;
    document.getElementById('usuario-view').style.display = 'inline';
    document.getElementById('usuario-edit').style.display = 'none';
    document.getElementById('editar-usuario').style.display = 'inline';
    document.getElementById('salvar-usuario').style.display = 'none';
}