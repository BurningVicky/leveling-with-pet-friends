<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-page-container">
    <div class="page-header-flex">
        <div>
            <h2>Editar Pet: <?= htmlspecialchars($animal['nome']) ?></h2>
            <p class="subtitle">Atualize os dados e a foto do animal selecionado.</p>
        </div>
        <a href="index.php?route=admin-manage-animals" class="btn btn-outline">&larr; Voltar à Gestão</a>
    </div>

    <div class="card-box form-box" style="max-width: 650px; margin: 0 auto;">
        <form action="index.php?route=admin-animal-edit&id=<?= $animal['id'] ?>" method="POST" enctype="multipart/form-data" class="form-styled">
            
            <div class="form-group">
                <label>Foto Atual</label>
                <div style="margin-bottom: 1rem;">
                    <img src="<?= htmlspecialchars($animal['imagem'] ?? 'https://via.placeholder.com/150') ?>" alt="<?= htmlspecialchars($animal['nome']) ?>" style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border);">
                </div>
                <label for="imagem_arquivo">Alterar Foto (deixe em branco para manter a atual)</label>
                <input type="file" name="imagem_arquivo" id="imagem_arquivo" accept="image/png, image/jpeg, image/webp">
            </div>

            <div class="form-group">
                <label for="nome">Nome do Pet</label>
                <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($animal['nome']) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="especie">Espécie</label>
                    <select name="especie" id="especie" required>
                        <option value="Cão" <?= $animal['especie'] === 'Cão' ? 'selected' : '' ?>>Cão</option>
                        <option value="Gato" <?= $animal['especie'] === 'Gato' ? 'selected' : '' ?>>Gato</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo" required>
                        <option value="Macho" <?= $animal['sexo'] === 'Macho' ? 'selected' : '' ?>>Macho</option>
                        <option value="Fêmea" <?= $animal['sexo'] === 'Fêmea' ? 'selected' : '' ?>>Fêmea</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="idade">Idade (anos)</label>
                    <input type="number" name="idade" id="idade" min="0" value="<?= htmlspecialchars($animal['idade']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="raca">Raça</label>
                    <input type="text" name="raca" id="raca" value="<?= htmlspecialchars($animal['raca']) ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="cor">Cor da Pelagem</label>
                <input type="text" name="cor" id="cor" value="<?= htmlspecialchars($animal['cor']) ?>" required>
            </div>

            <div class="form-group">
                <label for="status">Situação</label>
                <select name="status" id="status" required>
                    <option value="Disponível" <?= $animal['status'] === 'Disponível' ? 'selected' : '' ?>>Disponível</option>
                    <option value="Em Processo" <?= $animal['status'] === 'Em Processo' ? 'selected' : '' ?>>Em Processo</option>
                    <option value="Adotado" <?= $animal['status'] === 'Adotado' ? 'selected' : '' ?>>Adotado</option>
                    <option value="Indisponível" <?= $animal['status'] === 'Indisponível' ? 'selected' : '' ?>>Indisponível</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Salvar Alterações</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>