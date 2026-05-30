<?php
/**
 * Luminários — Configuração do Banco de Dados
 * Banco: biblioteca_mysql_db  |  Tabela principal: livros_mysql
 */
$host = 'localhost';
$db   = 'biblioteca_mysql_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE,            PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,   false);
} catch (PDOException $e) {
    error_log('Erro na conexão MySQL: ' . $e->getMessage());
    http_response_code(500);
    exit('Erro na conexão MySQL: ' . $e->getMessage());
}
