# 📚 Luminários — Sistema de Gerenciamento de Livros

Este é um projeto acadêmico desenvolvido durante o curso no **SENAI Diadema**. O **Luminários** é uma plataforma focada na organização e catalogação de acervos literários. 

Para explorar diferentes conceitos de arquitetura de software e persistência de dados, o projeto foi construído em **duas versões totalmente independentes** dentro deste mesmo repositório, permitindo comparar o comportamento de um banco local em arquivo contra um SGBD baseado em servidor.

---

## 📂 Estrutura do Repositório

O repositório está organizado nas seguintes pastas:

* `📁 projeto-livros-sqlite/` -> Versão ágil e focada em fluxo de leitura. Utiliza banco de dados **SQLite** incorporado.
* `📁 projeto-livros-mysql/` -> Versão estendida com catálogo completo, filtros de busca, FAQ e controle de tema. Utiliza banco de dados **MySQL**.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (utilizando PDO para conexões seguras e Prepared Statements contra SQL Injection).
* **Front-end:** JavaScript (Vanilla), HTML5 e CSS3 (com suporte a temas dinâmicos).
* **Bancos de Dados:** MySQL e SQLite.
* **Acessibilidade:** Integração com o componente **VLibras** para tradução de conteúdos em LIBRAS.

---

## 🚀 Funcionalidades por Versão

### 💾 Versão SQLite (`projeto-livros-sqlite`)
* **Foco em Leitura:** Cadastro simplificado contendo Título, Autor e Status de leitura dinâmico (ex: "Quero Ler").
* **Autenticação via Servidor:** Login de demonstração validado diretamente no backend (`leitor` / `1234`).
* **Painel Unificado:** Interface limpa onde as operações de inserção, listagem e exclusão acontecem de forma integrada.

### 🐬 Versão MySQL (`projeto-livros-mysql`)
* **Catálogo Estendido:** Cadastro completo de obras com Título, Autor, Gênero literário, Ano de publicação e Descrição detalhada.
* **Busca e Filtros Avançados:** Filtre livros por gênero ou faça buscas textuais ordenando por títulos, autores ou registros mais recentes.
* **Gerenciamento de Tema:** Alternância em tempo real entre Modo Claro e Modo Escuro via JavaScript persistido no navegador.
* **Central de Ajuda & FAQ:** Página de contato estruturada com seções de dúvidas frequentes sanadas via componentes interativos.
* **Sessão Inteligente:** Simulação de login e cadastro de usuários utilizando persistência em `LocalStorage`.

---

## 📦 Como Executar o Projeto

### Pré-requisitos
* Servidor local ativo (recomendado usar o **Laragon**, mas compatível com XAMPP ou WampServer).
* PHP 8.x com as extensões `pdo_mysql` e `pdo_sqlite` habilitadas no arquivo `php.ini`.

### Passo a Passo para Testar

1. **Clone o repositório na pasta raiz do seu servidor local (ex: `www` ou `htdocs`):**
   ```bash
   git clone [https://github.com/seu-usuario/nome-do-repositorio.git](https://github.com/seu-usuario/nome-do-repositorio.git)
