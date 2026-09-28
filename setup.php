<?php
require_once __DIR__ . '/src/Models/Database.php';

try {
    $db = Database::getConnection();

    // Cria as tabelas
    $db->exec("
        CREATE TABLE IF NOT EXISTS administrador (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            senha VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS animal (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome VARCHAR(100) NOT NULL,
            especie VARCHAR(50) NOT NULL,
            sexo VARCHAR(20) NOT NULL,
            idade INTEGER NOT NULL,
            raca VARCHAR(50) NOT NULL,
            cor VARCHAR(50) NOT NULL,
            status VARCHAR(30) DEFAULT 'Disponível',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );

        CREATE TABLE IF NOT EXISTS solicitacao_adocao (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            animal_id INTEGER NOT NULL,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            telefone VARCHAR(20) NOT NULL,
            mensagem TEXT NOT NULL,
            status VARCHAR(30) DEFAULT 'Pendente',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (animal_id) REFERENCES animal(id) ON DELETE CASCADE
        );
    ");

    // Insere um admin inicial e alguns animais de teste se a tabela estiver vazia
    $check = $db->query("SELECT COUNT(*) FROM animal")->fetchColumn();
    if ($check == 0) {
        // Admin (senha: admin123)
        $senhaHash = password_hash('admin123', PASSWORD_DEFAULT);
        $db->exec("INSERT INTO administrador (nome, email, senha) VALUES ('Administrador', 'admin@petfriends.com', '$senhaHash')");

        // Animais de teste
        $db->exec("INSERT INTO animal (nome, especie, sexo, idade, raca, cor, status) VALUES 
            ('D-Dog', 'Cão', 'Macho', 2, 'SRD', 'Castanho', 'Disponível'),
            ('Meowth', 'Gato', 'Macho', 1, 'Siamês', 'Branco e Bege', 'Disponível'),
            ('Cerberus', 'Cão', 'Macho', 3, 'Doberman', 'Preto', 'Disponível');
        ");
    }

    echo "Banco de dados inicializado e populado com sucesso!\n";
} catch (Exception $e) {
    echo "Erro ao inicializar o banco: " . $e->getMessage() . "\n";
}