# Leveling With Pet Friends

Plataforma web para gestão de resgates e facilitação da adoção responsável de animais de estimação. O sistema conecta adotantes a animais disponíveis e fornece uma interface administrativa para controle de cadastros e solicitações de adoção.

---

## Sumário

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades](#funcionalidades)
- [Arquitetura e Tecnologias](#arquitetura-e-tecnologias)
- [Estrutura de Diretórios](#estrutura-de-diretórios)
- [Requisitos do Sistema](#requisitos-do-sistema)
- [Instalação e Execução](#instalação-e-execução)
- [Uso da Aplicação](#uso-da-aplicação)
- [Licença](#licença)

---

## Sobre o Projeto

O **Leveling With Pet Friends** foi desenvolvido no âmbito acadêmico como parte do Projeto Integrador VI-A (UCPel). A aplicação visa simplificar o processo de adoção de pets, permitindo que a comunidade visualize animais resgatados, faça solicitações de adoção e interaja com imagens e informações detalhadas. Para os administradores, oferece um painel centralizado para gerenciamento de registros e controle de pedidos.

---

## Funcionalidades

### Área Pública (Adotantes)
- **Home / Destaques**: Exibição dos últimos 3 animais cadastrados e chamada para ações rápidas.
- **Catálogo de Animais**: Listagem completa de pets disponíveis com suporte a filtragem por espécie (Cão, Gato).
- **Detalhes do Pet**: Visualização detalhada de informações (idade, sexo, raça, cor) e formulário para envio de solicitação de adoção.
- **Visualização de Imagens (Lightbox)**: Zoom interativo em tela cheia para fotografias dos animais na Home, no catálogo e na página de detalhes.

### Área Administrativa (Painel de Controle)
- **Autenticação Segura**: Acesso restrito via sessão para usuários administradores.
- **Gestão de Animais (CRUD)**: Cadastrar novos pets (com upload de imagem), editar informações e remover registros.
- **Gestão de Solicitações**: Acompanhamento de pedidos de adoção organizados por status (Pendente, Aprovada, Rejeitada) com atualização automática do status do pet ao aprovar uma adoção.
- **Painel de Métricas Gerais**: Indicadores com total de animais, animais disponíveis, solicitações pendentes e adotados.
- **Gestão de Equipe**: Cadastro de novos administradores para uso colaborativo.

---

## Arquitetura e Tecnologias

A aplicação segue o padrão arquitetural **MVC (Model-View-Controller)** com Front Controller.

- **Linguagem Backend**: PHP 8.x
- **Banco de Dados**: SQLite 3 via PDO
- **Frontend**: HTML5, CSS3 (Flexbox/Grid), JavaScript Vanilla
- **Roteamento**: Front Controller (`public/index.php`)
- **Gerenciamento de Arquivos**: Sistema de upload local para armazenamento de imagens (`public/uploads/`)

---

## Estrutura de Diretórios

.
├── public/
│   ├── css/
│   │   └── style.css
│   ├── uploads/
│   └── index.php
├── src/
│   ├── Controllers/
│   │   ├── AnimalController.php
│   │   ├── AdoptionsController.php
│   │   └── AuthController.php
│   ├── Models/
│   │   ├── Animal.php
│   │   └── Adoption.php
│   └── Views/
│       ├── admin/
│       │   ├── dashboard.php
│       │   ├── manage-animals.php
│       │   └── manage-adoptions.php
│       ├── public/
│       │   ├── home.php
│       │   ├── list-animals.php
│       │   └── animal-details.php
│       └── templates/
│           ├── header.php
│           └── footer.php
├── database.sqlite
└── README.md

## Requisitos do Sistema

- PHP 8.0 ou superior
- Extensão `pdo_sqlite` habilitada no PHP
- Servidor web (Apache, Nginx ou o servidor embutido do PHP)

---

## Instalação e Execução

1. **Clonar o repositório**
   bash
   git clone [https://github.com/BurningVicky/leveling-with-pet-friends.git](https://github.com/BurningVicky/leveling-with-pet-friends.git)
   cd leveling-with-pet-friends

2. **Iniciar o servidor PHP**

Certifique-se de que o arquivo database.sqlite está presente na raiz ou que as permissões de escrita estejam configuradas corretamente no diretório.

Iniciar o servidor embutido do PHP

Bash
php -S localhost:8000 -t public


3. **Acessar a Aplicação**
Abra o navegador e acesse: http://localhost:8000

## Uso da Aplicação

1. **Acesso Administrativo**
Para acessar a área administrativa, navegue até http://localhost:8000/index.php?route=login.

Após o login, o painel exibirá as métricas gerais do sistema e permitirá gerenciar o catálogo de animais e as solicitações de adoção recebidas.

2. **Solicitando uma Adoção**
Na página inicial ou na listagem de animais, clique em "Conhecer" no pet desejado.

Preencha o formulário de interesse na página de detalhes do animal.

A solicitação ficará visível no painel administrativo para análise do status.

## Licença
Este projeto é desenvolvido para fins acadêmicos e educacionais no âmbito do Projeto Integrador VI-A da Universidade Católica de Pelotas (UCPel).