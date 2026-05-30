README - SOLUÇÃO DE PROBLEMAS E CONFIGURAÇÃO DO BANCO DE DADOS

Caso ocorra algum erro ao tentar acessar as páginas "Catálogo" ou "Adicionar Livro", siga o passo a passo abaixo para criar as tabelas necessárias no banco de dados usando o Laragon e o HeidiSQL.

COMO CORRIGIR:

1. Abra o Laragon e certifique-se de que os serviços (Apache e MySQL) estão iniciados.
2. No painel do Laragon, clique no botão "Database" para abrir o HeidiSQL.
3. Se você ainda não criou o banco de dados do projeto, clique com o botão direito em cima da sua conexão (no lado esquerdo), vá em "Criar novo" -> "Banco de dados" e dê o nome correto do projeto.
4. Com o banco de dados selecionado, aperte o atalho "Ctrl + T" no teclado para abrir uma nova aba de comando SQL.
5. Abra o arquivo "schema.sql" que está na raiz do seu projeto e copie todo o conteúdo dele.
6. Cole esse código copiado dentro da aba de comando que você abriu no HeidiSQL.
7. Pressione a tecla F9 (ou clique no ícone azul de "Play") para executar o código e criar as tabelas.

DICA: Após executar o código, clique com o botão direito no nome do seu banco de dados no menu esquerdo e escolha "Atualizar" (ou aperte F5) para confirmar que as tabelas foram criadas com sucesso.