<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="admin-page-container">
    <div class="page-header-flex">
        <div>
            <h2>Cadastrar Novo Administrador</h2>
            <p class="subtitle">Adicione um novo membro para gerenciar a plataforma.</p>
        </div>
        <a href="index.php?route=admin-dashboard" class="btn btn-outline">&larr; Voltar ao Painel</a>
    </div>

    <div class="auth-container" style="min-height: auto; padding: 0;">
        <div class="auth-card" style="max-width: 500px;">
            <form action="index.php?route=admin-register" method="POST" class="form-styled">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" name="nome" id="nome" required placeholder="Ex: Vicky Bandeira">
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" required placeholder="vicky@petfriends.com">
                </div>

                <div class="form-group">
                    <label for="senha">Senha de Acesso</label>
                    <input type="password" name="senha" id="senha" required placeholder="Mínimo 6 caracteres">
                </div>

                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 1.5rem;">Cadastrar Administrador</button>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>