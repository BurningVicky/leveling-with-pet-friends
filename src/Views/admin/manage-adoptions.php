<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-page-container">
    <div class="page-header-flex">
        <div>
            <h2>Solicitações de Adoção</h2>
            <p class="subtitle">Gerencie os pedidos dos adotantes e atualize as etapas do processo.</p>
        </div>
        <a href="index.php?route=admin-dashboard" class="btn btn-outline">&larr; Voltar ao Painel</a>
    </div>

    <!-- Filtros por Stage / Status -->
    <div class="filter-bar-admin" style="margin-bottom: 1.5rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
        <a href="index.php?route=admin-manage-adoptions" class="btn btn-outline btn-sm">Todas</a>
        <a href="index.php?route=admin-manage-adoptions&status=Pendente" class="btn btn-outline btn-sm">⏳ Pendentes</a>
        <a href="index.php?route=admin-manage-adoptions&status=Aprovada" class="btn btn-outline btn-sm">✅ Aprovadas</a>
        <a href="index.php?route=admin-manage-adoptions&status=Rejeitada" class="btn btn-outline btn-sm">❌ Rejeitadas</a>
    </div>

    <div class="card-box">
        <div class="table-responsive">
            <table class="data-table-modern">
                <thead>
                    <tr>
                        <th>Pet</th>
                        <th>Adotante</th>
                        <th>Contato</th>
                        <th>Mensagem</th>
                        <th>Status</th>
                        <th>Ações (Alterar Stage)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($solicitacoes)): ?>
                        <?php foreach ($solicitacoes as $item): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                                        <img src="<?= htmlspecialchars($item['animal_imagem'] ?? 'https://via.placeholder.com/50') ?>" class="table-thumb" alt="<?= htmlspecialchars($item['animal_nome']) ?>">
                                        <div>
                                            <strong><?= htmlspecialchars($item['animal_nome']) ?></strong>
                                            <div style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($item['animal_especie']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($item['nome']) ?></strong>
                                </td>
                                <td>
                                    <div>📧 <?= htmlspecialchars($item['email']) ?></div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">📞 <?= htmlspecialchars($item['telefone'] ?: 'Não informado') ?></div>
                                </td>
                                <td>
                                    <?php if (!empty($item['mensagem'])): ?>
                                        <button type="button" class="btn btn-outline btn-sm" onclick="alert('Mensagem de <?= htmlspecialchars(addslashes($item['nome'])) ?>:\n\n<?= htmlspecialchars(addslashes($item['mensagem'])) ?>')">
                                            📖 Ver Mensagem
                                        </button>
                                    <?php else: ?>
                                        <span style="color: var(--text-muted); font-size: 0.85rem;">Sem mensagem</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        $statusClass = 'badge-pendente';
                                        if ($item['status'] === 'Aprovada') $statusClass = 'badge-aprovada';
                                        if ($item['status'] === 'Rejeitada') $statusClass = 'badge-rejeitada';
                                    ?>
                                    <span class="badge <?= $statusClass ?>">
                                        <?= htmlspecialchars($item['status'] ?? 'Pendente') ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.4rem;">
                                        <?php if (($item['status'] ?? 'Pendente') !== 'Aprovada'): ?>
                                            <a href="index.php?route=admin-adoption-status&id=<?= $item['id'] ?>&status=Aprovada" 
                                               class="btn btn-secondary btn-sm"
                                               onclick="return confirm('Aprovar a solicitação de <?= htmlspecialchars($item['nome']) ?>?');">
                                                Aprovar
                                            </a>
                                        <?php endif; ?>

                                        <?php if (($item['status'] ?? 'Pendente') !== 'Rejeitada'): ?>
                                            <a href="index.php?route=admin-adoption-status&id=<?= $item['id'] ?>&status=Rejeitada" 
                                               class="btn-danger-sm"
                                               onclick="return confirm('Rejeitar esta solicitação?');">
                                                Rejeitar
                                            </a>
                                        <?php endif; ?>

                                        <?php if (($item['status'] ?? 'Pendente') !== 'Pendente'): ?>
                                            <a href="index.php?route=admin-adoption-status&id=<?= $item['id'] ?>&status=Pendente" 
                                               class="btn btn-outline btn-sm">
                                                Resetar
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2.5rem 0; color: var(--text-muted);">
                                Nenhuma solicitação encontrada para o filtro selecionado.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>