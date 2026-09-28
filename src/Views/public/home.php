<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="container">
    <!-- Hero Banner -->
    <div class="hero-banner">
        <h1>Encontre seu novo amigo de quatro patas 🐾</h1>
        <p>O seu companheiro de aventuras está aqui!</p>
        <div class="hero-actions">
            <a href="index.php?route=animals" class="btn btn-primary">Ver Todos para Adoção</a>
            <a href="index.php?route=animals&especie=Cão" class="btn btn-outline" style="color: #fff; border-color: #fff;">🐶 Conhecer Cães</a>
            <a href="index.php?route=animals&especie=Gato" class="btn btn-outline" style="color: #fff; border-color: #fff;">🐱 Conhecer Gatos</a>
        </div>
    </div>

    <!-- Destaques -->
    <div class="section-title-wrapper">
        <div>
            <h2>Resgatados Recentes</h2>
            <p class="subtitle">Conheça os Pets</p>
        </div>
        <a href="index.php?route=animals" class="btn btn-outline btn-sm">Ver Galeria Completa &rarr;</a>
    </div>

    <div class="cards-grid">
        <?php if (!empty($animais)): ?>
            <?php foreach (array_slice($animais, 0, 3) as $pet): ?>
                <?php $imagemPet = htmlspecialchars($pet['imagem'] ?? 'https://via.placeholder.com/400x300?text=Sem+Foto'); ?>
                <div class="pet-card">
                    <!-- Imagem Clicável para Zoom -->
                    <div class="pet-card-image pet-image-zoomable" onclick="openImageModal('<?= $imagemPet ?>', '<?= htmlspecialchars($pet['nome']) ?>')">
                        <img src="<?= $imagemPet ?>" alt="<?= htmlspecialchars($pet['nome']) ?>">
                        <span class="pet-badge"><?= htmlspecialchars($pet['especie']) ?></span>
                        <div class="zoom-hint">🔍 Ampliar</div>
                    </div>

                    <div class="pet-card-body">
                        <h3><?= htmlspecialchars($pet['nome']) ?></h3>
                        <p><strong>Raça:</strong> <?= htmlspecialchars($pet['raca'] ?? 'Não informada') ?></p>
                        <p><strong>Sexo:</strong> <?= htmlspecialchars($pet['sexo']) ?></p>
                        <p><strong>Idade:</strong> <?= htmlspecialchars($pet['idade']) ?> ano(s)</p>
                    </div>

                    <div class="pet-card-footer">
                        <a href="index.php?route=animal-details&id=<?= $pet['id'] ?>" class="btn btn-secondary btn-block">Conhecer <?= htmlspecialchars($pet['nome']) ?></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 3rem 0;">
                <p class="no-results">Nenhum pet disponível no momento. Volte em breve!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Lightbox para Zoom das Fotos -->
<div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
    <span class="image-modal-close" onclick="closeImageModal(event)">&times;</span>
    <img class="image-modal-content" id="modalImg" alt="Foto ampliada do pet">
    <div id="modalCaption" class="image-modal-caption"></div>
</div>

<script>
function openImageModal(src, name) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');
    const modalCaption = document.getElementById('modalCaption');

    modal.style.display = 'flex';
    modalImg.src = src;
    modalCaption.textContent = name;
    document.body.style.overflow = 'hidden';
}

function closeImageModal(e) {
    if (!e || e.target.id === 'imageModal' || e.target.classList.contains('image-modal-close') || e.key === 'Escape') {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal(e);
    }
});
</script>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>