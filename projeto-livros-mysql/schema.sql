-- ============================================================
-- Luminários — Schema do Banco de Dados (v2)
-- Banco: biblioteca_mysql_db | Tabela: livros_mysql
-- Execute este arquivo antes de usar o sistema.
-- ============================================================

CREATE DATABASE IF NOT EXISTS biblioteca_mysql_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE biblioteca_mysql_db;

CREATE TABLE IF NOT EXISTS livros_mysql (
    id        INT          NOT NULL AUTO_INCREMENT,
    titulo    VARCHAR(100) NOT NULL,
    autor     VARCHAR(100) NOT NULL,
    genero    VARCHAR(100) NOT NULL DEFAULT 'outro',
    ano       YEAR         DEFAULT NULL,
    descricao TEXT         DEFAULT NULL,
    capa_url  VARCHAR(500) DEFAULT NULL,
    criado_em TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_titulo (titulo),
    INDEX idx_autor  (autor),
    INDEX idx_genero (genero)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dados de exemplo
INSERT INTO livros_mysql (titulo, autor, genero, ano, descricao) VALUES
('A Guerra dos Tronos',             'George R. R. Martin', 'fantasia',  1996, 'Primeiro livro de As Crônicas de Gelo e Fogo. Fantasia épica sobre intrigas políticas e a batalha pelo Trono de Ferro.'),
('Dexter: A Mão Esquerda de Deus',  'Jeff Lindsay',        'thriller',  2004, 'Dexter Morgan, perito forense de Miami que esconde uma face sombria: um serial killer seletivo.'),
('The Boys: O Nome do Jogo',        'Garth Ennis',         'acao',      2006, 'Super-heróis corruptos vs. um esquadrão implacável da CIA.'),
('O Espelho de Assis',              'Marcus Robson Costa', 'literatura',2022, 'Paralelo investigativo com o clássico Dom Casmurro de Machado de Assis.');
