<?= view('partials/header', ['title' => 'Connexion', 'variant' => 'auth']) ?>

<div class="auth-card">
    <div class="text-center mb-4">
        <h1 class="auth-title">Connexion</h1>
        <p class="auth-subtitle">Connectez-vous avec votre numéro</p>
    </div>

    <?php if (session()->getFlashdata('erreur')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
    <?php endif; ?>

    <form action="/auth/verifier" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Numéro de téléphone</label>
            <input type="text" name="numero" class="form-control" placeholder="034 XX XXX XX"  maxlength="10" pattern="[0-9]{10}" required>
        </div>
        <button type="submit" class="btn btn-brand w-100">Se connecter</button>
        <a href="/operateur/login" class="d-block text-center">Connexion opérateur</a>

    </form>
</div>

<?= view('partials/footer') ?>