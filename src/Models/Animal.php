<?php
require_once __DIR__ . '/Database.php';

class Animal {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function listarTodos(?string $especie = null): array {
        if ($especie) {
            $stmt = $this->db->prepare("SELECT * FROM animal WHERE especie = :especie ORDER BY id DESC");
            $stmt->execute([':especie' => $especie]);
        } else {
            $stmt = $this->db->query("SELECT * FROM animal ORDER BY id DESC");
        }
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM animal WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $animal = $stmt->fetch();
        return $animal ?: null;
    }

    public function criar(array $dados): bool {
        $sql = "INSERT INTO animal (nome, especie, sexo, idade, raca, cor, imagem, status) 
                VALUES (:nome, :especie, :sexo, :idade, :raca, :cor, :imagem, :status)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nome'    => $dados['nome'],
            ':especie' => $dados['especie'],
            ':sexo'    => $dados['sexo'],
            ':idade'   => $dados['idade'],
            ':raca'    => $dados['raca'],
            ':cor'     => $dados['cor'],
            ':imagem'  => !empty($dados['imagem']) ? $dados['imagem'] : 'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=400',
            ':status'  => $dados['status'] ?? 'Disponível'
        ]);
    }

    public function atualizar(int $id, array $dados): bool {
        $sql = "UPDATE animal SET nome = :nome, especie = :especie, sexo = :sexo, 
                idade = :idade, raca = :raca, cor = :cor, imagem = :imagem, status = :status, 
                updated_at = CURRENT_TIMESTAMP WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'      => $id,
            ':nome'    => $dados['nome'],
            ':especie' => $dados['especie'],
            ':sexo'    => $dados['sexo'],
            ':idade'   => $dados['idade'],
            ':raca'    => $dados['raca'],
            ':cor'     => $dados['cor'],
            ':imagem'  => $dados['imagem'],
            ':status'  => $dados['status']
        ]);
    }

    public function atualizarStatus(int $id, string $status): bool {
    $sql = "UPDATE animal SET status = :status WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([
        ':status' => $status,
        ':id'     => $id
    ]);
}

    public function deletar(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM animal WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}