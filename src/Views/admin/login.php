<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Acesso Administrativo</h2>
        <p>Informe as suas credenciais para gerir o sistema.</p>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="index.php?route=login" method="POST" class="form-admin">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required placeholder="admin@email.com">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>