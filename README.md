# 📚 Sistema de Gerenciamento de Livros

Este é um projeto acadêmico desenvolvido durante o curso no **SENAI Diadema**. O objetivo principal da aplicação é gerenciar um acervo de livros (CRUD completo). 

Para explorar diferentes arquiteturas de armazenamento, o projeto foi desenvolvido em **duas versões totalmente independentes** dentro deste repositório: uma utilizando o SGBD **MySQL** (baseado em servidor) e outra utilizando o **SQLite** (baseado em arquivo local).

---

## 📂 Estrutura do Repositório

O repositório está dividido da seguinte forma:

*   `📁 versao-mysql/` -> Código-fonte e script SQL configurados para rodar com o banco de dados MySQL.
*   `📁 versao-sqlite/` -> Código-fonte e base de dados prontos para rodar localmente com o SQLite.

---

## 🚀 Funcionalidades (Ambas as Versões)

* **Autenticação de Usuários:** Controle de acesso para a área administrativa.
* **CRUD de Livros:** Cadastro, leitura, atualização e exclusão de títulos, autores e categorias.
* **Filtros Dinâmicos:** Sistema de busca rápida no front-end utilizando JavaScript (Vanilla).
* **Interface Responsiva:** Visual adaptável para computadores e dispositivos móveis.

---

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (utilizando PDO para garantir a segurança e portabilidade das consultas).
* **Front-end:** JavaScript, HTML5 e CSS3.
* **Bancos de Dados:** MySQL e SQLite.

---

## 📦 Como Executar o Projeto

### Pré-requisitos
* Servidor local (XAMPP, WampServer ou Laragon).
* PHP 8.x com as extensões `pdo_mysql` e `pdo_sqlite` ativas no `php.ini`.

### Passo a Passo

1. **Clone o repositório:**
```bash
   git clone [https://github.com/seu-usuario/nome-do-repositorio.git](https://github.com/seu-usuario/nome-do-repositorio.git)
