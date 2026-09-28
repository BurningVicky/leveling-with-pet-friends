<?php
require_once __DIR__ . '/../Models/Adoption.php';

class AdoptionsController {
    private Adoption $adoptionModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->adoptionModel = new Adoption();
    }

    // --- PÚBLICO: Enviar solicitação de adoção ---
    public function submit(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $animalId = (int)($_POST['animal_id'] ?? 0);
            $nome     = trim($_POST['nome'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $mensagem = trim($_POST['mensagem'] ?? '');

            if ($animalId > 0 && !empty($nome) && !empty($email)) {
                $this->adoptionModel->criar($animalId, $nome, $email, $telefone, $mensagem);
                header('Location: index.php?route=animal-details&id=' . $animalId . '&status=success');
                exit;
            }
        }
        header('Location: index.php?route=animals');
        exit;
    }

    // --- ADMINISTRATIVO: Gerenciar solicitações ---
    public function manage(): void {
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $solicitacoes = $this->adoptionModel->listarTodas();
        require_once __DIR__ . '/../Views/admin/manage-adoptions.php';
    }

    public function updateStatus(): void {
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id     = (int)($_POST['id'] ?? 0);
            $status = trim($_POST['status'] ?? 'Pendente');

            if ($id > 0) {
                $this->adoptionModel->atualizarStatus($id, $status);
            }
        }
        header('Location: index.php?route=admin-manage-adoptions');
        exit;
    }
}