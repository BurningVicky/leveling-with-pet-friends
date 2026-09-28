<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-dashboard">
    <div class="dashboard-header">
        <h2>Painel de Gestão</h2>
        <p>Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['admin_nome'] ?? 'Administrador') ?></strong>!</p>
    </div>

    <div class="admin-nav-cards">
        <a href="index.php?route=admin-manage-animals" class="card-nav">
            <h3>🐾 Gestão de Animais</h3>
            <p>Cadastrar, editar, remover e atualizar a situação dos cães e gatos.</p>
        </a>

        <a href="index.php?route=admin-manage-adoptions" class="card-nav">
            <h3>📋 Solicitações de Adoção</h3>
            <p>Visualizar e responder aos pedidos de adoção enviados pelo público.</p>
        </a>

        <a href="index.php?route=admin-register" class="card-nav">
            <h3>👤 Cadastrar Administrador</h3>
            <p>Adicionar novas credenciais de acesso à equipe do sistema.</p>
        </a>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>