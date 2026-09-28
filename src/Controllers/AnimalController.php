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

    // Listagem pública (Home e catálogo)
    public function home(): void {
        $animaisDestaque = array_slice($this->animalModel->listarTodos(), 0, 3);
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

    // Ações Administrativas
    public function manage(): void {
        $this->verificarAuth();
        $animais = $this->animalModel->listarTodos();
        require_once __DIR__ . '/../Views/admin/manage-animals.php';
    }

    public function create(): void {
        $this->verificarAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caminhoImagem = 'https://via.placeholder.com/300x200?text=Sem+Foto';

            // Processamento do Upload da Foto
            if (isset($_FILES['imagem_arquivo']) && $_FILES['imagem_arquivo']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['imagem_arquivo']['tmp_name'];
                $fileName = $_FILES['imagem_arquivo']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($fileExtension, $extensoesPermitidas)) {
                    // Gera um nome único para o arquivo para evitar sobreposição
                    $novoNome = uniqid('pet_', true) . '.' . $fileExtension;
                    $diretorioUpload = __DIR__ . '/../../public/uploads/';

                    // Cria o diretório se não existir
                    if (!is_dir($diretorioUpload)) {
                        mkdir($diretorioUpload, 0755, true);
                    }

                    $caminhoDestino = $diretorioUpload . $novoNome;

                    if (move_uploaded_file($fileTmpPath, $caminhoDestino)) {
                        $caminhoImagem = 'uploads/' . $novoNome;
                    }
                }
            }

            $dados = [
                'nome'    => trim($_POST['nome'] ?? ''),
                'especie' => trim($_POST['especie'] ?? ''),
                'sexo'    => trim($_POST['sexo'] ?? ''),
                'idade'   => (int)($_POST['idade'] ?? 0),
                'raca'    => trim($_POST['raca'] ?? ''),
                'cor'     => trim($_POST['cor'] ?? ''),
                'imagem'  => $caminhoImagem,
                'status'  => trim($_POST['status'] ?? 'Disponível')
            ];

            $this->animalModel->criar($dados);
            header('Location: index.php?route=admin-manage-animals');
            exit;
        }
    }

    public function edit(): void {
        $this->verificarAuth();

        $id = (int)($_GET['id'] ?? 0);
        $animal = $this->animalModel->buscarPorId($id);

        if (!$animal) {
            header('Location: index.php?route=admin-manage-animals');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $caminhoImagem = $animal['imagem']; // Mantém a imagem antiga por padrão

            // Verifica se um novo arquivo de imagem foi enviado
            if (isset($_FILES['imagem_arquivo']) && $_FILES['imagem_arquivo']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['imagem_arquivo']['tmp_name'];
                $fileName = $_FILES['imagem_arquivo']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

                if (in_array($fileExtension, $extensoesPermitidas)) {
                    $novoNome = uniqid('pet_', true) . '.' . $fileExtension;
                    $diretorioUpload = __DIR__ . '/../../public/uploads/';

                    if (!is_dir($diretorioUpload)) {
                        mkdir($diretorioUpload, 0755, true);
                    }

                    $caminhoDestino = $diretorioUpload . $novoNome;

                    if (move_uploaded_file($fileTmpPath, $caminhoDestino)) {
                        $caminhoImagem = 'uploads/' . $novoNome;
                    }
                }
            }

            $dados = [
                'nome'    => trim($_POST['nome'] ?? ''),
                'especie' => trim($_POST['especie'] ?? ''),
                'sexo'    => trim($_POST['sexo'] ?? ''),
                'idade'   => (int)($_POST['idade'] ?? 0),
                'raca'    => trim($_POST['raca'] ?? ''),
                'cor'     => trim($_POST['cor'] ?? ''),
                'imagem'  => $caminhoImagem,
                'status'  => trim($_POST['status'] ?? 'Disponível')
            ];

            $this->animalModel->atualizar($id, $dados);
            header('Location: index.php?route=admin-manage-animals');
            exit;
        }

        require_once __DIR__ . '/../Views/admin/edit-animal.php';
    }

    public function delete(): void {
        $this->verificarAuth();
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->animalModel->deletar($id);
        }
        header('Location: index.php?route=admin-manage-animals');
        exit;
    }

    private function verificarAuth(): void {
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }
    }
}