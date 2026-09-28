<?php
// Exibe erros em ambiente de desenvolvimento
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/Controllers/AnimalController.php';
require_once __DIR__ . '/../src/Controllers/AdoptionsController.php';
require_once __DIR__ . '/../src/Controllers/AuthController.php';

$route = $_GET['route'] ?? 'home';

switch ($route) {
    // --- ROTAS PÚBLICAS ---
    case 'home':
        (new AnimalController())->home();
        break;

    case 'animals':
        (new AnimalController())->list();
        break;

    case 'animal-details':
        (new AnimalController())->details();
        break;

    case 'adopt-submit':
        (new AdoptionsController())->submit();
        break;

    // --- ROTAS ADMINISTRATIVAS ---
    case 'login':
        (new AuthController())->login();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'admin-dashboard':
        if (empty($_SESSION['admin_logged'])) {
            header('Location: index.php?route=login');
            exit;
        }
        require_once __DIR__ . '/../src/Views/admin/dashboard.php';
        break;

    case 'admin-manage-animals':
        (new AnimalController())->manage();
        break;

    case 'admin-animal-create':
        (new AnimalController())->create();
        break;

    case 'admin-animal-edit':
        (new AnimalController())->edit();
        break;

    case 'admin-animal-delete':
        (new AnimalController())->delete();
        break;

    case 'admin-manage-adoptions':
        (new AdoptionsController())->manage();
        break;

    case 'admin-register':
        (new AuthController())->register();
        break;

    // --- ROTA DE ERRO 404 ---
    default:
        http_response_code(404);
        echo "<h1>Página não encontrada (404)</h1>";
        break;
}