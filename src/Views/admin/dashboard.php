<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="dashboard-wrapper">
    <div class="dashboard-welcome">
        <h2>Painel de Controle Administrativo</h2>
        <p>Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['admin_nome'] ?? 'Administrador') ?></strong> 👋</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">🐾</div>
            <div class="stat-info">
                <h3>Gestão de Animais</h3>
                <p>Cadastre novos pets, edite fichas e atualize fotos e status de adoção.</p>
                <a href="index.php?route=admin-manage-animals" class="btn btn-primary btn-sm">Acessar Animais &rarr;</a>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">📥</div>
            <div class="stat-info">
                <h3>Solicitações de Adoção</h3>
                <p>Analise os pedidos enviados pelos adotantes e altere o status de aprovação.</p>
                <a href="index.php?route=admin-manage-adoptions" class="btn btn-secondary btn-sm">Ver Solicitações &rarr;</a>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">👤</div>
            <div class="stat-info">
                <h3>Equipe & Acessos</h3>
                <p>Cadastre novos administradores para gerenciar o sistema de forma colaborativa.</p>
                <a href="index.php?route=admin-register" class="btn btn-outline btn-sm">Novo Admin &rarr;</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>