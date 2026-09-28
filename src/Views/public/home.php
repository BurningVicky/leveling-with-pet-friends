<?php require_once __DIR__ . '/../templates/header.php'; ?>

<section class="hero-section">
    <div class="hero-content">
        <h1>Encontre o seu companheiro de Aventuras</h1>
        <p>Adote um amigo de quatro patas, descubra novos horitontes!</p>
        <a href="index.php?route=animals" class="btn btn-primary">Ver Pets Disponíveis</a>
    </div>
</section>

<section class="featured-animals">
    <h2>Pets em Destaque</h2>
    <div class="grid-animais">
        <?php if (!empty($animaisDestaque)): ?>
            <?php foreach ($animaisDestaque as $pet): ?>
                <div class="card-animal">
                    <div class="card-body">
                        <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                        <p class="tag-especie"><?= htmlspecialchars($pet['especie']) ?></p>
                        <p><strong>Idade:</strong> <?= htmlspecialchars($pet['idade']) ?> ano(s)</p>
                        <p><strong>Raça:</strong> <?= htmlspecialchars($pet['raca']) ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="index.php?route=animal-details&id=<?= $pet['id'] ?>" class="btn btn-secondary">Conhecer <?= htmlspecialchars($pet['nome']) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Não há Pets em destaque no momento.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>