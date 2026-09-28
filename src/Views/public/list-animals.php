<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <div class="page-header-flex" style="margin-bottom: 2rem; align-items: center;">
        <div>
            <h2>Pets Disponíveis para Adoção 🐾</h2>
            <p class="subtitle">Encontre o seu novo companheiro e transforme uma vida.</p>
        </div>

        <div class="filter-box">
            <a href="index.php?route=animals" class="btn btn-outline btn-sm">Todos</a>
            <a href="index.php?route=animals&especie=Cão" class="btn btn-outline btn-sm">🐶 Cães</a>
            <a href="index.php?route=animals&especie=Gato" class="btn btn-outline btn-sm">🐱 Gatos</a>
        </div>
    </div>

    <div class="cards-grid">
        <?php if (!empty($animais)): ?>
            <?php foreach ($animais as $pet): ?>
                <div class="pet-card">
                    <div class="pet-card-image">
                        <img src="<?= htmlspecialchars($pet['imagem'] ?? 'https://via.placeholder.com/300x200?text=Sem+Foto') ?>" alt="<?= htmlspecialchars($pet['nome']) ?>">
                        <span class="pet-badge"><?= htmlspecialchars($pet['especie']) ?></span>
                    </div>
                    <div class="pet-card-body">
                        <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                        <p><strong>Raça:</strong> <?= htmlspecialchars($pet['raca'] ?? 'Não informada') ?></p>
                        <p><strong>Sexo:</strong> <?= htmlspecialchars($pet['sexo']) ?></p>
                        <p><strong>Idade:</strong> <?= htmlspecialchars($pet['idade']) ?> ano(s)</p>
                    </div>
                    <div class="pet-card-footer">
                        <a href="index.php?route=animal-details&id=<?= $pet['id'] ?>" class="btn btn-secondary btn-block">Mais Detalhes</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 0;">
                <p class="no-results">Nenhum Pet encontrado com os filtros atuais.</p>
                <a href="index.php?route=animals" class="btn btn-primary" style="margin-top: 1rem;">Ver Todos</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>