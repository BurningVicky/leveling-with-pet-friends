<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="page-header">
    <h2>Pets Disponíveis para Adoção</h2>
    <div class="filtros">
        <a href="index.php?route=animals" class="btn btn-outline">Todos</a>
        <a href="index.php?route=animals&especie=Cão" class="btn btn-outline">Cães</a>
        <a href="index.php?route=animals&especie=Gato" class="btn btn-outline">Gatos</a>
    </div>
</div>

<div class="grid-animais">
    <?php if (!empty($animais)): ?>
        <?php foreach ($animais as $pet): ?>
            <div class="card-animal">
                <div class="card-body">
                    <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                    <p class="tag-especie"><?= htmlspecialchars($pet['especie']) ?></p>
                    <p><strong>Sexo:</strong> <?= htmlspecialchars($pet['sexo']) ?></p>
                    <p><strong>Idade:</strong> <?= htmlspecialchars($pet['idade']) ?> ano(s)</p>
                </div>
                <div class="card-footer">
                    <a href="index.php?route=animal-details&id=<?= $pet['id'] ?>" class="btn btn-secondary">Mais Detalhes</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum Pet encontrado com os filtros atuais.</p>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>