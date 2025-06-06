function novaconta() {
    let novousername = document.getElementById('novoUsername').value
    let novoemail = document.getElementById('novoEmail').value
    let novasenha = document.getElementById('novaSenha').value
    
    contas.push(
        {
            username : novousername,
            email : novoemail,
            senha : novasenha
        }
    )
}