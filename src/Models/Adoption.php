<?php
require_once __DIR__ . '/Database.php';

class Adoption {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function criar(int $animalId, string $nome, string $email, string $telefone, string $mensagem): bool {
        $sql = "INSERT INTO solicitacao_adocao (animal_id, nome, email, telefone, mensagem) 
                VALUES (:animal_id, :nome, :email, :telefone, :mensagem)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':animal_id' => $animalId,
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':mensagem' => $mensagem
        ]);
    }

    public function listarTodas(): array {
        $sql = "SELECT s.*, a.nome AS animal_nome, a.especie AS animal_especie 
                FROM solicitacao_adocao s 
                JOIN animal a ON s.animal_id = a.id 
                ORDER BY s.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function atualizarStatus(int $id, string $status): bool {
        $sql = "UPDATE solicitacao_adocao SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':status' => $status
        ]);
    }
}