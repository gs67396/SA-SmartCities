# SA-SmartCities
Situação de aprendigem feita ao longo do ano de 2025 no curso de Desenvolvimento de Sistemas por : Gabriel dos Santos, Guilherme Ramos Alvim e Caio alves da Maia

Título do projeto: SA-Smart Cities (Smart Train)

Objetivo do projeto: O nosso objetivo é oferecer um transporte seguro e que seja eficiente para os nossos usuários, assim queremos que os usuários possam aproveitar uma boa viagem pela cidade de Joinville.

Contexto: 

Funcionalidades principais: Como funcionabilidades temos: 
1. Dashboard geral com informações de trens, rotas, itinerários e manutenção;
2. CRUD de sensores, rotas, trens, gerenciamento de alertas, manutenção de trens;
3. Paginas extras como: Um guia e uma pagina de apesentação sobre nós.

Tecnologias utilizadas:

1. GitHub
2. Visual Studio Code
3. HTML
4. CSS
5. JAVASCRIPTY
6. PHP
7. SQL

Equipe de desenvolvimento:

1. Guilherme ramos alvim
2. Gabriel dos santos
3. Caio alves da maia

Estrutura do repositório:

```
SA-SmartCities/
├── CSS/                         # Estilos da aplicação
│   ├── loginstyle.css           # Estilos da página de login
│   ├── menu.css                 # Estilos da navegação
│   ├── rotasstyle.css           # Estilos da página de rotas
│   └── traininfostyle.css       # Estilos das informações de trens
│
├── IMAGENS/                      # Recursos de imagens do projeto
│
├── JAVASCRIPT/                   # Scripts cliente
│   ├── menu.js                  # Funcionalidades do menu
│   ├── notificacao.js           # Sistema de notificações
│   └── rotas.js                 # Funcionalidades de rotas
│
├── PHP/                          # Backend da aplicação
│   ├── CODIGO/                  # Lógica de negócio
│   │   ├── apagarconta.php      # Deletar conta de usuário
│   │   ├── bd.php               # Conexão com banco de dados
│   │   ├── excluirtrem.php      # Deletar trem
│   │   ├── menu.php             # Renderização do menu
│   │   ├── mudaremail.php       # Alterar email
│   │   ├── mudarnome.php        # Alterar nome
│   │   ├── mudarsenha.php       # Alterar senha
│   │   └── sair.php             # Logout
│   │
│   └── PAGINAS/                 # Páginas da aplicação
│       ├── Adicionar_Alerta.php     # Criar novo alerta
│       ├── Alertas.php              # Listar e gerenciar alertas
│       ├── cadastrartrem.php        # Cadastrar novo trem
│       ├── configuracoes.php        # Página de configurações
│       ├── Gerenciamento_sensores.php  # CRUD de sensores
│       ├── Inicio.php               # Dashboard principal
│       ├── login.php                # Página de autenticação
│       ├── Manual_usuario.php       # Guia de usuário
│       ├── novaconta.php            # Registro de nova conta
│       ├── relatotio.php            # Relatórios
│       ├── rotas.php                # Gerenciamento de rotas
│       ├── Sobre_nós.php            # Página sobre a equipe
│       └── traininfo.php            # Informações dos trens
│
├── SQL/                          # Banco de dados
│   ├── banco.sql                # Script de criação do banco
│   └── contas.txt               # Arquivo de contas (referência)
│
├── LICENSE                       # Licença do projeto
└── README.md                     # Este arquivo
```

Licença:

GNU GENERAL PUBLIC LICENSE

Informações complementares:

## Requisitos do Sistema

- PHP 7.4+
- MySQL 5.7+
- Apache com mod_rewrite ativado
- Navegador moderno (Chrome, Firefox, Safari, Edge)

## Instalação Rápida

1. Clone o repositório
2. Configure a conexão com banco de dados em `PHP/CODIGO/bd.php`
3. Importe o arquivo `SQL/banco.sql` no seu MySQL
4. Coloque os arquivos na pasta `htdocs` do XAMPP
5. Acesse `http://localhost/SA-SmartCities/PHP/PAGINAS/login.php`

## Status do Projeto

- ✅ Em desenvolvimento - Situação de aprendizado (2025)
- 🎯 Funcionalidades principais implementadas
- 📋 Sistema de autenticação e gestão de usuários operacional

## Notas Importantes

- Este é um projeto educacional desenvolvido como situação de aprendizado
- Os dados são armazenados localmente no MySQL
- Recomenda-se usar em ambiente de desenvolvimento
- Verificar permissões de arquivo e pasta antes de executar