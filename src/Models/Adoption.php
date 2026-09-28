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
            ':nome'      => $nome,
            ':email'     => $email,
            ':telefone'  => $telefone,
            ':mensagem'  => $mensagem
        ]);
    }

    public function listarTodas(?string $status = null): array {
        $sql = "SELECT s.*, a.nome AS animal_nome, a.especie AS animal_especie, a.imagem AS animal_imagem 
                FROM solicitacao_adocao s 
                JOIN animal a ON s.animal_id = a.id";
        
        if ($status) {
            $sql .= " WHERE s.status = :status";
        }

        $sql .= " ORDER BY s.id DESC";

        $stmt = $this->db->prepare($sql);
        if ($status) {
            $stmt->execute([':status' => $status]);
        } else {
            $stmt->execute();
        }

        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT s.*, a.nome AS animal_nome FROM solicitacao_adocao s JOIN animal a ON s.animal_id = a.id WHERE s.id = :id");
        $stmt->execute([':id' => $id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public function atualizarStatus(int $id, string $status): bool {
        $sql = "UPDATE solicitacao_adocao SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'     => $id,
            ':status' => $status
        ]);
    }
}