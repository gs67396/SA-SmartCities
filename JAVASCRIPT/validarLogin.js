function validar(){
    let email = document.getElementById('LoEmail').value
    let senha = document.getElementById('LoSenha').value

    for(let i = 0 ; i< contas.length;i++ ){
        if(email == contas[i].email && senha == contas[i].senha){
            window.location.href = 'file:///C:/Users/gabriel_santos67/Documents/SA-SmartCities/HTML/Inicio.html'
            return
        }
    }
    alert('E-mail ou senha incoretos.');
}