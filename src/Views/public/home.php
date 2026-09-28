<?php require_once __DIR__ . '/../templates/header.php'; ?>

<section class="hero-banner">
    <div class="hero-text">
        <h1>Encontre o seu novo melhor amigo 🐾</h1>
        <p>Adoção responsável de cães e gatos resgatados. Transforme uma vida hoje mesmo!</p>
        <a href="index.php?route=animals" class="btn btn-primary btn-lg">Ver Todos os Animais</a>
    </div>
</section>

<section class="featured-section">
    <div class="section-title">
        <h2>Pets em Destaque</h2>
        <p>Conheça alguns dos nossos amiguinhos que estão à procura de um lar cheio de amor.</p>
    </div>

    <div class="cards-grid">
        <?php if (!empty($animaisDestaque)): ?>
            <?php foreach ($animaisDestaque as $pet): ?>
                <div class="pet-card">
                    <div class="pet-card-image">
                        <img src="<?= htmlspecialchars($pet['imagem'] ?? 'https://via.placeholder.com/300x200') ?>" alt="<?= htmlspecialchars($pet['nome']) ?>">
                        <span class="pet-badge"><?= htmlspecialchars($pet['especie']) ?></span>
                    </div>
                    <div class="pet-card-body">
                        <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                        <p><strong>Raça:</strong> <?= htmlspecialchars($pet['raca']) ?></p>
                        <p><strong>Idade:</strong> <?= htmlspecialchars($pet['idade']) ?> ano(s)</p>
                    </div>
                    <div class="pet-card-footer">
                        <a href="index.php?route=animal-details&id=<?= $pet['id'] ?>" class="btn btn-secondary btn-block">Conhecer <?= htmlspecialchars($pet['nome']) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-results">Não há pets em destaque no momento.</p>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>