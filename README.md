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
* Servidor local ativo (como Laragon, XAMPP ou WampServer).
* PHP 8.x com as extensões `pdo_mysql` e `pdo_sqlite` habilitadas no arquivo `php.ini`.

### Passo a Passo para Testar

1. **Clone o repositório na pasta raiz do seu servidor local (ex: `www` ou `htdocs`):**
   ```bash
   git clone [https://github.com/luminarios-org/gerenciamento-livros.git](https://github.com/luminarios-org/gerenciamento-livros.git)
   ```

2. **Para rodar a versão SQLite:**
   * Acesse a pasta `/projeto-livros-sqlite`.
   * O arquivo de banco `biblioteca.db` já está presente e configurado. Certifique-se apenas de que a pasta tenha permissões de escrita no seu sistema operacional para permitir novos cadastros.
   * Abra no seu navegador: `http://localhost/gerenciamento-livros/projeto-livros-sqlite/index.php`.

3. **Para rodar a versão MySQL:**
   * Acesse a pasta `/projeto-livros-mysql`.
   * Importe o script `/projeto-livros-mysql/schema.sql` em seu gerenciador de banco de dados para criar automaticamente a base `biblioteca_mysql_db` e a tabela `livros_mysql` populada com dados de exemplo.
   * Verifique as credenciais no arquivo `config.php` (o padrão está configurado com usuário `root` e senha vazia).
   * Abra no seu navegador: `http://localhost/gerenciamento-livros/projeto-livros-mysql/index.php`.
   
   > ⚠️ **Nota Importante:** Caso encontre qualquer erro ao tentar acessar as páginas de "Catálogo" ou "Adicionar Livro" na versão MySQL, abra e siga atentamente o passo a passo de solução de problemas descrito no arquivo **`README.txt`** localizado dentro da própria pasta `/projeto-livros-mysql`.

---

## 🏫 Instituição & Autores

* **Curso:** Técnico em Desenvolvimento de Sistemas
* **Instituição:** SENAI Diadema — Escola "Manuel Garcia Filho"
* **Integrantes do Grupo:**
  * Kauan Barboza
  * Kauã Everton
  * Nicolas
  * Riquelme
  * Luan
  * Felipe
  * Hyago
