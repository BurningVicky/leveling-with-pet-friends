<?php
require_once __DIR__ . '/Database.php';

class Admin {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function autenticar(string $email, string $senha): ?array {
        $stmt = $this->db->prepare("SELECT * FROM administrador WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            unset($user['senha']);
            return $user;
        }
        return null;
    }

    public function cadastrar(string $nome, string $email, string $senha): bool {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO administrador (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senhaHash
        ]);
    }
}