<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="dashboard-wrapper" style="padding-top: 1.5rem; padding-bottom: 3rem;">
    <!-- Cabeçalho de Boas-Vindas -->
    <div class="dashboard-welcome" style="margin-bottom: 2rem;">
        <h2 style="font-size: 1.8rem; color: var(--bg-dark, #0f172a);">Painel de Controle Administrativo</h2>
        <p class="subtitle" style="margin-top: 0.2rem;">
            Bem-vindo(a), <strong><?= htmlspecialchars($_SESSION['admin_nome'] ?? 'Administrador') ?></strong> 👋
        </p>
    </div>

    <!-- Grid de Atalhos / Métricas -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        <!-- Card 1: Animais -->
        <div class="stat-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border, #e2e8f0); box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; gap: 1rem;">
            <div class="stat-icon" style="font-size: 2rem;">🐾</div>
            <div class="stat-info" style="display: flex; flex-direction: column; gap: 0.5rem; width: 100%;">
                <h3 style="font-size: 1.2rem; color: var(--bg-dark, #0f172a);">Gestão de Animais</h3>
                <p style="font-size: 0.9rem; color: #64748b; flex-grow: 1;">
                    Cadastre novos pets, edite fichas e atualize fotos e status de adoção.
                </p>
                <div>
                    <a href="index.php?route=admin-manage-animals" class="btn btn-primary btn-sm">Acessar Animais &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card 2: Solicitações -->
        <div class="stat-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border, #e2e8f0); box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; gap: 1rem;">
            <div class="stat-icon" style="font-size: 2rem;">📥</div>
            <div class="stat-info" style="display: flex; flex-direction: column; gap: 0.5rem; width: 100%;">
                <h3 style="font-size: 1.2rem; color: var(--bg-dark, #0f172a);">Solicitações de Adoção</h3>
                <p style="font-size: 0.9rem; color: #64748b; flex-grow: 1;">
                    Analise os pedidos enviados pelos adotantes e altere o status de aprovação.
                </p>
                <div>
                    <a href="index.php?route=admin-manage-adoptions" class="btn btn-secondary btn-sm">Ver Solicitações &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card 3: Admins -->
        <div class="stat-card" style="background: #ffffff; padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border, #e2e8f0); box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; gap: 1rem;">
            <div class="stat-icon" style="font-size: 2rem;">👤</div>
            <div class="stat-info" style="display: flex; flex-direction: column; gap: 0.5rem; width: 100%;">
                <h3 style="font-size: 1.2rem; color: var(--bg-dark, #0f172a);">Equipe & Acessos</h3>
                <p style="font-size: 0.9rem; color: #64748b; flex-grow: 1;">
                    Cadastre novos administradores para gerenciar o sistema de forma colaborativa.
                </p>
                <div>
                    <a href="index.php?route=admin-register" class="btn btn-outline btn-sm">Novo Admin &rarr;</a>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>