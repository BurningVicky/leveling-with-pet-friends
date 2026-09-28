<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="auth-container">
    <div class="auth-box">
        <div class="header-with-back">
            <h2>Novo Administrador</h2>
            <a href="index.php?route=admin-dashboard" class="btn-link">&larr; Voltar</a>
        </div>
        <p>Preencha os dados abaixo para registar um novo acesso administrativo.</p>

        <form action="index.php?route=admin-register" method="POST" class="form-admin">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required placeholder="Nome completo">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required placeholder="admin@email.com">
            </div>

            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required placeholder="********">
            </div>

            <button type="submit" class="btn btn-primary btn-block">[ Cadastrar ]</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>