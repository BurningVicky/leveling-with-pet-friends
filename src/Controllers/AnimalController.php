<?php
require_once __DIR__ . '/../Models/Animal.php';

class AnimalController {
    private Animal $animalModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->animalModel = new Animal();
    }

    // --- ÁREA PÚBLICA ---

    public function home(): void {
        $animaisDestaque = $this->animalModel->listarTodos();
        // Limita os destaques da Home aos 3 primeiros
        $animaisDestaque = array_slice($animaisDestaque, 0, 3);
        require_once __DIR__ . '/../Views/public/home.php';
    }

    public function list(): void {
        $especie = $_GET['especie'] ?? null;
        $animais = $this->animalModel->listarTodos($especie);
        require_once __DIR__ . '/../Views/public/list-animals.php';
    }

    public function details(): void {
        $id = (int)($_GET['id'] ?? 0);
        $animal = $this->animalModel->buscarPorId($id);

        if (!$animal) {
            header('Location: index.php?route=animals');
            exit;
        }

        require_once __DIR__ . '/../Views/public/animal-details.php';
    }

    // --- ÁREA ADMINISTRATIVA ---

    private function checkAuth(): void {
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }
    }

    public function manage(): void {
        $this->checkAuth();
        $animais = $this->animalModel->listarTodos();
        require_once __DIR__ . '/../Views/admin/manage-animals.php';
    }

    public function create(): void {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome'    => trim($_POST['nome'] ?? ''),
                'especie' => trim($_POST['especie'] ?? ''),
                'sexo'    => trim($_POST['sexo'] ?? ''),
                'idade'   => (int)($_POST['idade'] ?? 0),
                'raca'    => trim($_POST['raca'] ?? ''),
                'cor'     => trim($_POST['cor'] ?? ''),
                'status'  => trim($_POST['status'] ?? 'Disponível')
            ];

            if (!empty($dados['nome']) && !empty($dados['especie'])) {
                $this->animalModel->criar($dados);
                header('Location: index.php?route=admin-manage-animals');
                exit;
            }
        }

        require_once __DIR__ . '/../Views/admin/manage-animals.php';
    }

    public function edit(): void {
        $this->checkAuth();
        $id = (int)($_GET['id'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome'    => trim($_POST['nome'] ?? ''),
                'especie' => trim($_POST['especie'] ?? ''),
                'sexo'    => trim($_POST['sexo'] ?? ''),
                'idade'   => (int)($_POST['idade'] ?? 0),
                'raca'    => trim($_POST['raca'] ?? ''),
                'cor'     => trim($_POST['cor'] ?? ''),
                'status'  => trim($_POST['status'] ?? 'Disponível')
            ];

            $this->animalModel->atualizar($id, $dados);
            header('Location: index.php?route=admin-manage-animals');
            exit;
        }
    }

    public function delete(): void {
        $this->checkAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->animalModel->deletar($id);
        }
        header('Location: index.php?route=admin-manage-animals');
        exit;
    }
}