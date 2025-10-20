<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../CSS/traininfostyle.css">
  <link rel="stylesheet" href="../../CSS/menu.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Belleza&display=swap" rel="stylesheet">
  <title>Manual do usuario</title>
</head>

<body>
  <?php include("../CODIGO/menu.php"); ?>
     <div class='home'><button id='menuButtonOpen' onclick='openav()'><img id='icon'
                src='../../IMAGENS/Hamburger_icon.svg.png'></button>
            </div>
    <script src='../../JAVASCRIPT/menu.js'>
    </script>
  <div class="infoLogo">Ajuda</div>
  <hr>

  <br>
  <h2>Introdução</h2>
  <br>
  <div class="box free">
    <p style="
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Bem-vindo ao SamrtTrain! Este guia irá ajudá-lo a entender como utilizar as principais funcionalidades do sistema para que seu dia de trem seja tranquilo.</p>
    
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>1. Introdução caminhos</summary>
      <p>Informações sobre a introdução ao sistema de trens. Após o login, na página de início, mostra o hambúrguer da tela inicial e, após o login:</p>
      <img src="../../IMAGENS/hamburguer.png" alt="acoes do hamburguer" class="img_manual">
      <p>Após apertar o icone do hambúrguer aparecera os links</p>
      <img src="../../IMAGENS/links_do_hamburguer.png" alt="acoes do hamburguer" class="img_manual">
    
    </details>
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>2. Página de Início</summary>
      <p>Na página de início, selecione um dos trens para verificar suas informações e as possíveis rotas dele.</p>
      <img src="../../IMAGENS/trem.png" alt="Mudar foto do perfil" class="img_manual">
      <p>Dá para ver os alertas do trem apertando o ícone vermelho com o número 1.</p>
    </details>
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>3. Página de Rotas</summary>
      <p>Você podera visualizar todas as rotas.</p>
      <img src="../../IMAGENS/todas_rotas.png" alt="rotas" class="img_manual">
      <p>A categoria atual exibe a atual rota que está selecionada.</p>
      <img src="../../IMAGENS/atuais_rotas.png" alt="rotas" class="img_manual">
      <p>A categoria alertas mostrará qualquer alerta que a rota poderá ter.</p>

    </details>
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>4. Configuracoes</summary>
      <p>Configurações do usuario</p>
      <details class="selecao">
        <summary>4.1 Sair do perfil</summary>
        <p>Apertar no botao para sair do perfil para poder voltar na tela de login</p>
        <img src="../../IMAGENS/sair_perfil.png" alt="Botao de logout" class="img_manual">
      </details>
      <details class="selecao">
        <summary>4.2 Mudar foto</summary>
        <p>Apertar no icone de foto para mudar a foto do perfil</p>
        <img src="../../IMAGENS/foto_de_perfil.png" alt="Mudar foto do perfil" class="img_manual">
      </details>
      <details class="selecao">
        <summary>4.3 mudar nome</summary>
        <p>Apertar no icone editar e depois te pedira para escrever o novo nome que deseja colocar</p>
        <img src="../../IMAGENS/Editar_nome_de_usuario.png" alt="Mudar nome do perfil" class="img_manual">
      </details>
      <details class="selecao">
        <summary>4.4 Mudar senha</summary>
        <p>Apertar no icone editar e depois te pedira para escrever o atual e a nova senha que deseja colocar</p>
        <p>A senha nao podera ser a mesma</p>
        <img src="../../IMAGENS/editar_senha.png" alt="Mudar senha do perfil" class="img_manual">
        <img src="../../IMAGENS/Salvar_senha.png" alt="Mudar senha do perfil" class="img_manual">
      </details>
      <details class="selecao">
        <summary>4.5 apagar conta</summary>
        <p>Apertar no botao apagar conta e depois confirmar a decisao de apagar a conta</p>
        <img src="../../IMAGENS/Apagar_conta.png" alt="Apagar conta do perfil" class="img_manual">
      </details>
    </details>
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>5.boas praticas</summary>
      <p>➤ Como acessar o sistema com segurança:</p>
      <p>Nunca compartilhe sua senha com outras pessoas.</p>
      <p>Use senhas fortes, com letras, números e caracteres especiais diversos.</p>
      <p>Sempre faça logout ao usar computadores públicos.</p>
      <p>Atualize seus dados pessoais sempre que necessário.</p>
      <p>Fique atento a mensagens de alerta do sistema.</p>
      <p>Não reutilize a mesma senha em outros sites.</p>
      <p>Em caso de dúvida, entre em contato com o suporte.</p>
    </details>
  </div>

  <div class="bigbox">
    <details class="selecao">
      <summary>6.Suporte</summary>
      <p>Para ajudar a perguntas mais especificas e mais perguntadas</p>
      <details class="selecao">
        <summary>6.1 Perguntas frequentes</summary>
        <p>➤ Quais são os requisitos para criar uma senha segura? </p>
        <p>Recomendacoes seguintes na senha: Que a senha contenha letras, numero e um caractere especial, minimo 8 digitos.</p>
        <p>➤ A minha senha pode ser vista de alguma forma? </p>
        <p>Não os dados sao escondidos com criptrografia, onde se torna impossivel outros usuarios verem a sua conta.</p>
      </details>
      <details class="selecao">
        <summary>6.2 Contatos</summary>
        <p>Telefone: 47 98881 9133</p>
        <p>Email: Suporte_trem@smartraimail.com</p>
      </details>
    </details>
  </div>

</body>

</html>