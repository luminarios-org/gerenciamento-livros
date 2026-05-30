# 📚 Sistema de Gerenciamento de Livros

Este é um projeto acadêmico desenvolvido durante o curso no **SENAI Diadema**. O objetivo principal da aplicação é gerenciar um acervo de livros através de um CRUD completo (Cadastro, Consulta, Atualização e Exclusão).

Para explorar diferentes arquiteturas de armazenamento, o projeto foi dividido em **duas versões independentes** dentro deste repositório: uma utilizando o SGBD **MySQL** (baseado em servidor) e outra utilizando o **SQLite** (baseado em arquivo local).

---

## 📂 Estrutura do Repositório

O repositório está organizado da seguinte forma:

* `📁 projeto-livros-mysql/` -> Código-fonte e script SQL configurados para rodar com o banco de dados MySQL.
* `📁 projeto-livros-sqlite/` -> Código-fonte e base de dados prontos para rodar localmente com o SQLite.

---

## 🚀 Funcionalidades (Ambas as Versões)

* **Autenticação:** Controle de acesso para a área administrativa do sistema.
* **CRUD de Livros:** Gerenciamento completo de títulos, autores e categorias.
* **Filtros Dinâmicos:** Sistema de busca rápida no front-end utilizando JavaScript (Vanilla).
* **Interface Responsiva:** Layout adaptável para computadores e dispositivos móveis.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (utilizando PDO para garantir a portabilidade e segurança contra SQL Injection).
* **Front-end:** JavaScript, HTML5 e CSS3.
* **Bancos de Dados:** MySQL e SQLite.

---

## 📦 Como Executar o Projeto

### Pré-requisitos
* Servidor local (XAMPP, WampServer ou Laragon).
* PHP 8.x com as extensões `pdo_mysql` e `pdo_sqlite` devidamente habilitadas no arquivo `php.ini`.

### Passo a Passo

1. **Clone o repositório:**
   ```bash
   git clone [https://github.com/seu-usuario/nome-do-repositorio.git](https://github.com/seu-usuario/nome-do-repositorio.git)
