<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-manage-container">
    <div class="page-header">
        <h2>Solicitações de Adoção</h2>
        <a href="index.php?route=admin-dashboard" class="btn btn-outline">&larr; Voltar ao Painel</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Data</th>
                <th>Animal</th>
                <th>Interessado</th>
                <th>Contacto</th>
                <th>Mensagem</th>
                <th>Status</th>
                <th>Atualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($solicitacoes)): ?>
                <?php foreach ($solicitacoes as $req): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($req['created_at'])) ?></td>
                        <td><strong><?= htmlspecialchars($req['animal_nome']) ?></strong> (<?= htmlspecialchars($req['animal_especie']) ?>)</td>
                        <td><?= htmlspecialchars($req['nome']) ?></td>
                        <td>
                            <small><?= htmlspecialchars($req['email']) ?></small><br>
                            <small><?= htmlspecialchars($req['telefone']) ?></small>
                        </td>
                        <td><p class="table-msg"><?= htmlspecialchars($req['mensagem']) ?></p></td>
                        <td>
                            <span class="status-badge <?= strtolower($req['status']) ?>">
                                <?= htmlspecialchars($req['status']) ?>
                            </span>
                        </td>
                        <td>
                            <form action="index.php?route=admin-manage-adoptions" method="POST" class="form-inline-status">
                                <input type="hidden" name="id" value="<?= $req['id'] ?>">
                                <select name="status" onchange="this.form.submit()">
                                    <option value="Pendente" <?= $req['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                                    <option value="Aprovada" <?= $req['status'] === 'Aprovada' ? 'selected' : '' ?>>Aprovada</option>
                                    <option value="Rejeitada" <?= $req['status'] === 'Rejeitada' ? 'selected' : '' ?>>Rejeitada</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhuma solicitação de adoção recebida.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>