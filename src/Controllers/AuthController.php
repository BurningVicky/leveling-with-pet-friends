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
        // Se já estiver logado, redireciona direto para a dashboard
        if (!empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=admin-dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            $user = $this->adminModel->autenticar($email, $senha);

            if ($user) {
                // Registra os dados do administrador na sessão
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_id']     = $user['id'];
                $_SESSION['admin_nome']   = $user['nome'];
                $_SESSION['admin_email']  = $user['email'];

                // Redireciona para o dashboard do admin
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
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = trim($_POST['senha'] ?? '');

            if (!empty($nome) && !empty($email) && !empty($senha)) {
                $this->adminModel->cadastrar($nome, $email, $senha);
                header('Location: index.php?route=admin-dashboard');
                exit;
            }
        }
        require_once __DIR__ . '/../Views/admin/register-admin.php';
    }

    public function logout(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = array();
        session_destroy();
        header('Location: index.php?route=login');
        exit;
    }
}