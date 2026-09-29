<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-page-container">
    <div class="page-header-flex">
        <div>
            <h2>Gestão do Catálogo de Animais</h2>
            <p class="subtitle">Adicione e gerencie os pets cadastrados na plataforma.</p>
        </div>
        <a href="index.php?route=admin-dashboard" class="btn btn-outline">&larr; Voltar ao Painel</a>
    </div>

    <div class="admin-grid-layout">
        <!-- Formulário de Cadastro com Upload -->
        <div class="card-box form-box">
            <h3>Cadastrar Novo Pet</h3>
            <form action="index.php?route=admin-animal-create" method="POST" enctype="multipart/form-data" class="form-styled">
                <div class="form-group">
                    <label for="nome">Nome do Pet</label>
                    <input type="text" name="nome" id="nome" required placeholder="Ex: Alvina, Sif...">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="especie">Espécie</label>
                        <select name="especie" id="especie" required>
                            <option value="Cão">Cão</option>
                            <option value="Gato">Gato</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" required>
                            <option value="Macho">Macho</option>
                            <option value="Fêmea">Fêmea</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="idade">Idade (anos)</label>
                        <input type="number" name="idade" id="idade" min="0" required placeholder="Ex: 2">
                    </div>

                    <div class="form-group">
                        <label for="raca">Raça</label>
                        <input type="text" name="raca" id="raca" required placeholder="Ex: Vira-lata, Palico, Sphynx...">
                    </div>
                </div>

                <div class="form-group">
                    <label for="cor">Cor da Pelagem</label>
                    <input type="text" name="cor" id="cor" required placeholder="Ex: Caramelo, Preto e Branco">
                </div>

                <!-- Campo de Upload de Foto -->
                <div class="form-group">
                    <label for="imagem_arquivo">Foto do Pet</label>
                    <input type="file" name="imagem_arquivo" id="imagem_arquivo" accept="image/png, image/jpeg, image/webp">
                </div>

                <div class="form-group">
                    <label for="status">Situação</label>
                    <select name="status" id="status" required>
                        <option value="Disponível">Disponível</option>
                        <option value="Em Processo">Em Processo</option>
                        <option value="Adotado">Adotado</option>
                        <option value="Indisponível">Indisponível</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-block">+ Cadastrar Animal</button>
            </form>
        </div>

        <!-- Tabela com Exibição das Imagens Salvas -->
        <div class="card-box table-box">
            <h3>Animais Cadastrados</h3>
            <div class="table-responsive">
                <table class="data-table-modern">
                    <thead>
                        <tr>
                            <th>Foto</th>
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
                                    <td>
                                        <img src="<?= htmlspecialchars($pet['imagem'] ?? 'https://via.placeholder.com/80') ?>" alt="<?= htmlspecialchars($pet['nome']) ?>" class="table-thumb">
                                    </td>
                                    <td><strong><?= htmlspecialchars($pet['nome']) ?></strong></td>
                                    <td><?= htmlspecialchars($pet['especie']) ?></td>
                                    <td>
                                        <span class="badge badge-<?= strtolower(str_replace(' ', '-', $pet['status'])) ?>">
                                            <?= htmlspecialchars($pet['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="index.php?route=admin-animal-edit&id=<?= $pet['id'] ?>" class="btn btn-outline btn-sm">
                                            Editar
                                        </a>
                                        <a href="index.php?route=admin-animal-delete&id=<?= $pet['id'] ?>" 
                                           class="btn-danger-sm" 
                                           onclick="return confirm('Tem certeza que deseja remover este registro?');">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhum animal cadastrado até o momento.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>