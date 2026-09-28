<?php
require_once __DIR__ . '/../Models/Adoption.php';
require_once __DIR__ . '/../Models/Animal.php';

class AdoptionsController {
    private Adoption $adoptionModel;
    private Animal $animalModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->adoptionModel = new Adoption();
        $this->animalModel = new Animal();
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

        $filtroStatus = $_GET['status'] ?? null;
        $solicitacoes = $this->adoptionModel->listarTodas($filtroStatus);

        require_once __DIR__ . '/../Views/admin/manage-adoptions.php';
    }

    public function updateStatus(): void {
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }

        $id = (int)($_REQUEST['id'] ?? 0);
        $status = trim($_REQUEST['status'] ?? 'Pendente');

        $statusPermitidos = ['Pendente', 'Aprovada', 'Rejeitada'];

        if ($id > 0 && in_array($status, $statusPermitidos)) {
            $this->adoptionModel->atualizarStatus($id, $status);

            // Se for aprovada, altera o status do pet para "Adotado"
            if ($status === 'Aprovada') {
                $solicitacao = $this->adoptionModel->buscarPorId($id);
                if ($solicitacao && !empty($solicitacao['animal_id'])) {
                    // Chama o método focado apenas no status do pet
                    $this->animalModel->atualizarStatus((int)$solicitacao['animal_id'], 'Adotado');
                }
            }
        }

        header('Location: index.php?route=admin-manage-adoptions');
        exit;
    }
}