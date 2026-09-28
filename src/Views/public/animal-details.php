<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="container" style="padding-top: 1rem; padding-bottom: 3rem;">
    <a href="index.php?route=animals" class="btn btn-outline btn-sm" style="margin-bottom: 1.5rem;">&larr; Voltar para a Galeria</a>

    <?php if (!empty($_GET['status']) && $_GET['status'] === 'success'): ?>
        <div style="background: #dcfce7; color: #166534; padding: 1rem 1.25rem; border-radius: 10px; margin-bottom: 1.5rem; font-weight: 500;">
            🎉 Solicitação de adoção enviada com sucesso! A nossa equipe entrará em contato em breve.
        </div>
    <?php endif; ?>

    <?php if (!empty($animal)): ?>
        <?php $imagemPet = htmlspecialchars($animal['imagem'] ?? 'https://via.placeholder.com/600x400?text=Sem+Foto'); ?>
        
        <div class="pet-details-wrapper">
            <!-- Coluna da Foto -->
            <div>
                <div class="pet-details-gallery pet-image-zoomable" onclick="openImageModal('<?= $imagemPet ?>', '<?= htmlspecialchars($animal['nome']) ?>')">
                    <img src="<?= $imagemPet ?>" alt="<?= htmlspecialchars($animal['nome']) ?>">
                    <span class="pet-badge" style="font-size: 0.9rem; padding: 0.4rem 1rem;"><?= htmlspecialchars($animal['especie']) ?></span>
                    <div class="zoom-hint">🔍 Clique para ampliar</div>
                </div>
            </div>

            <!-- Coluna de Informações e Form -->
            <div class="pet-details-info">
                <div class="pet-header-title">
                    <div>
                        <h1><?= htmlspecialchars($animal['nome']) ?></h1>
                        <p class="subtitle" style="margin-top: 0.2rem;">Cadastrado para Adoção Responsável</p>
                    </div>
                    <span class="badge badge-<?= strtolower($animal['status'] ?? 'disponivel') ?>" style="font-size: 0.9rem;">
                        <?= htmlspecialchars($animal['status'] ?? 'Disponível') ?>
                    </span>
                </div>

                <!-- Grid de Atributos -->
                <div class="pet-spec-grid">
                    <div class="spec-card">
                        <span>Espécie</span>
                        <strong><?= htmlspecialchars($animal['especie']) ?></strong>
                    </div>
                    <div class="spec-card">
                        <span>Raça</span>
                        <strong><?= htmlspecialchars($animal['raca'] ?? 'SRD (Sem Raça Definida)') ?></strong>
                    </div>
                    <div class="spec-card">
                        <span>Sexo</span>
                        <strong><?= htmlspecialchars($animal['sexo']) ?></strong>
                    </div>
                    <div class="spec-card">
                        <span>Idade</span>
                        <strong><?= htmlspecialchars($animal['idade']) ?> ano(s)</strong>
                    </div>
                    <div class="spec-card" style="grid-column: span 2;">
                        <span>Cor Predominante</span>
                        <strong><?= htmlspecialchars($animal['cor'] ?? 'Não informada') ?></strong>
                    </div>
                </div>

                <!-- Formulário de Solicitação de Adoção -->
                <?php if (($animal['status'] ?? 'Disponível') !== 'Adotado'): ?>
                    <div class="adoption-form-card">
                        <h3 style="margin-bottom: 0.5rem; color: var(--bg-dark);">Tenho Interesse em Adotar o(a) <?= htmlspecialchars($animal['nome']) ?> 🐾</h3>
                        <p class="subtitle" style="margin-bottom: 1.2rem;">Preencha os seus dados para iniciarmos o processo de adoção.</p>

                        <form action="index.php?route=adopt-submit" method="POST" class="form-styled">
                            <input type="hidden" name="animal_id" value="<?= $animal['id'] ?>">

                            <div class="form-group">
                                <label for="nome">Seu Nome Completo</label>
                                <input type="text" name="nome" id="nome" required placeholder="Ex: Vicky Cavalheiro Bandeira">
                            </div>

                            <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div>
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email" required placeholder="vickycb@email.com">
                                </div>
                                <div>
                                    <label for="telefone">Telefone / WhatsApp</label>
                                    <input type="text" name="telefone" id="telefone" required placeholder="(53) 99999-9999">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mensagem">Mensagem / Conte um pouco sobre a sua rotina</label>
                                <textarea name="mensagem" id="mensagem" rows="3" placeholder="Ex: Possuo casa telada com pátio fechado e já tenho outro animal vacinado."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1rem;">Enviar Pedido de Adoção</button>
                        </form>
                    </div>
                <?php else: ?>
                    <div style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 1.5rem; border-radius: 12px; text-align: center;">
                        <h3>🎉 Este pet já foi adotado!</h3>
                        <p class="subtitle" style="margin-top: 0.5rem;">Ficamos muito felizes que <?= htmlspecialchars($animal['nome']) ?> encontrou um lar.</p>
                        <a href="index.php?route=animals" class="btn btn-primary" style="margin-top: 1rem;">Ver Outros Pets</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div style="text-align: center; padding: 4rem 0;">
            <h2>Ops! Pet não encontrado.</h2>
            <a href="index.php?route=animals" class="btn btn-primary">Voltar para a Galeria</a>
        </div>
    <?php endif; ?>
</div>

<!-- Lightbox Modal para Zoom da Imagem -->
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
    document.body.style.overflow = 'hidden'; // Impede o scroll de fundo
}

function closeImageModal(e) {
    // Fecha se clicar no X, fora da imagem ou disparar via ESC
    if (e.target.id === 'imageModal' || e.target.classList.contains('image-modal-close') || e.key === 'Escape') {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaura o scroll
    }
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal(e);
    }
});
</script>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>