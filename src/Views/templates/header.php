<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = !empty($_SESSION['admin_logged']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leveling With Pet Friends | Adoção Responsável</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="main-header">
        <div class="container header-container">
            <a href="index.php?route=home" class="brand-logo">
                🐾 <span>Leveling With Pet Friends</span>
            </a>
            
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php?route=home">Início</a></li>
                    <li><a href="index.php?route=animals">Animais Disponíveis</a></li>
                    
                    <?php if ($isLoggedIn): ?>
                        <li class="admin-badge"><a href="index.php?route=admin-dashboard">Painel Admin</a></li>
                        <li><a href="index.php?route=logout" class="btn-logout">Sair</a></li>
                    <?php else: ?>
                        <li><a href="index.php?route=login" class="btn-login-link">Área Restrita</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main-content container"></main>