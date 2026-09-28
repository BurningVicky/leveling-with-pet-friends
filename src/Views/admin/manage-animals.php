<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-manage-container">
    <div class="page-header">
        <h2>Gestão de Animais</h2>
        <a href="index.php?route=admin-dashboard" class="btn btn-outline">&larr; Voltar ao Painel</a>
    </div>

    <div class="admin-grid-layout">
        <!-- Formulário de Cadastro / Edição -->
        <div class="form-card">
            <h3>Cadastrar Novo Animal</h3>
            <form action="index.php?route=admin-animal-create" method="POST" class="form-admin">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="especie">Espécie:</label>
                    <select name="especie" id="especie" required>
                        <option value="Cão">Cão</option>
                        <option value="Gato">Gato</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <select name="sexo" id="sexo" required>
                        <option value="Macho">Macho</option>
                        <option value="Fêmea">Fêmea</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idade">Idade (anos):</label>
                    <input type="number" name="idade" id="idade" min="0" required>
                </div>

                <div class="form-group">
                    <label for="raca">Raça:</label>
                    <input type="text" name="raca" id="raca" required placeholder="Ex: SRD, Poodle...">
                </div>

                <div class="form-group">
                    <label for="cor">Cor:</label>
                    <input type="text" name="cor" id="cor" required>
                </div>

                <div class="form-group">
                    <label for="status">Situação:</label>
                    <select name="status" id="status" required>
                        <option value="Disponível">Disponível</option>
                        <option value="Em Processo">Em Processo</option>
                        <option value="Adotado">Adotado</option>
                        <option value="Indisponível">Indisponível</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Salvar Animal</button>
            </form>
        </div>

        <!-- Tabela de Registos -->
        <div class="table-card">
            <h3>Animais Registados</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($animais)): ?>
                        <?php foreach ($animais as $pet): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($pet['nome']) ?></strong></td>
                                <td><?= htmlspecialchars($pet['especie']) ?></td>
                                <td>
                                    <span class="status-badge <?= strtolower(str_replace(' ', '-', $pet['status'])) ?>">
                                        <?= htmlspecialchars($pet['status']) ?>
                                    </span>
                                </td>
                                <td class="actions-cell">
                                    <a href="index.php?route=admin-animal-delete&id=<?= $pet['id'] ?>" 
                                       class="btn-action delete" 
                                       onclick="return confirm('Tem certeza que deseja remover este registo?');">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhum animal registado até ao momento.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>