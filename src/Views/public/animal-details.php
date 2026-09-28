<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="animal-details-container">
    <div class="header-details">
        <h2>Conheça o(a) <?= htmlspecialchars($animal['nome']) ?></h2>
        <a href="index.php?route=animals" class="btn btn-outline">&larr; Voltar ao catálogo</a>
    </div>
    
    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
        <div class="alert alert-success">
            <strong>Sucesso!</strong> Sua solicitação de adoção foi enviada. Entraremos em contato em breve.
        </div>
    <?php endif; ?>

    <div class="animal-info-grid">
        <div class="info-card">
            <ul>
                <li><strong>Espécie:</strong> <?= htmlspecialchars($animal['especie']) ?></li>
                <li><strong>Raça:</strong> <?= htmlspecialchars($animal['raca']) ?></li>
                <li><strong>Sexo:</strong> <?= htmlspecialchars($animal['sexo']) ?></li>
                <li><strong>Idade:</strong> <?= htmlspecialchars($animal['idade']) ?> ano(s)</li>
                <li><strong>Cor:</strong> <?= htmlspecialchars($animal['cor']) ?></li>
                <li>
                    <strong>Status:</strong> 
                    <span class="status-badge <?= strtolower(str_replace(' ', '-', $animal['status'])) ?>">
                        <?= htmlspecialchars($animal['status']) ?>
                    </span>
                </li>
            </ul>
        </div>

        <div class="adoption-form-container">
            <?php if ($animal['status'] === 'Disponível'): ?>
                <h3>Tens interesse em adotar?</h3>
                <form action="index.php?route=adopt-submit" method="POST" class="form-adocao">
                    <input type="hidden" name="animal_id" value="<?= $animal['id'] ?>">
                    
                    <div class="form-group">
                        <label for="nome">Nome Completo:</label>
                        <input type="text" name="nome" id="nome" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone/WhatsApp:</label>
                        <input type="text" name="telefone" id="telefone" required>
                    </div>

                    <div class="form-group">
                        <label for="mensagem">Por que você deseja adotar este pet?</label>
                        <textarea name="mensagem" id="mensagem" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Enviar Solicitação</button>
                </form>
            <?php else: ?>
                <div class="alert alert-warning">
                    Este pet não está disponível para adoção no momento.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>