<?php
/**
 * conexao.php
 * Responsável pela conexão PDO com o banco SQLite (biblioteca.db)
 */
try {
    // Caminho absoluto baseado na localização deste arquivo
    $dbPath = __DIR__ . '/biblioteca.db';
    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Garante que a tabela existe (com a nova coluna 'status' por padrão)
    $pdo->exec("CREATE TABLE IF NOT EXISTS livros (
        id      INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo  TEXT    NOT NULL,
        autor   TEXT    NOT NULL,
        status  TEXT    NOT NULL DEFAULT 'Quero Ler'
    )");

    // Segurança: se a tabela já existia antes sem a coluna status, este bloco adiciona-a
    try {
        @$pdo->exec("ALTER TABLE livros ADD COLUMN status TEXT NOT NULL DEFAULT 'Quero Ler'");
    } catch (Exception $e) {
        // Ignora o erro se a coluna já existir no banco de dados
    }

} catch (PDOException $e) {
    die(json_encode(['erro' => 'Erro na conexão SQLite: ' . $e->getMessage()]));
}
?>