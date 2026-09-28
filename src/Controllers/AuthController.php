<?php
require_once __DIR__ . '/../Models/Admin.php';

class AuthController {
    private Admin $adminModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->adminModel = new Admin();
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            $user = $this->adminModel->autenticar($email, $senha);
            if ($user) {
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_nome'] = $user['nome'];
                header('Location: index.php?route=admin-dashboard');
                exit;
            } else {
                $erro = "E-mail ou senha inválidos.";
                require_once __DIR__ . '/../Views/admin/login.php';
            }
        } else {
            require_once __DIR__ . '/../Views/admin/login.php';
        }
    }

    public function register(): void {
        // Exige autenticação prévia de um admin ativo (Relacionamento <<includes>>)
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $this->adminModel->cadastrar($nome, $email, $senha);
                header('Location: index.php?route=admin-dashboard');
                exit;
            }
        }
        require_once __DIR__ . '/../Views/admin/register-admin.php'; // Pode criar este arquivo na views/admin
    }

    public function logout(): void {
        session_destroy();
        header('Location: index.php?route=login');
        exit;
    }
}