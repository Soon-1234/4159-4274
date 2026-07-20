<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Opérateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="auth-wrap">
    <div class="auth-card">
        <div class="text-center mb-4">
            <h1 class="auth-title">Espace Opérateur</h1>
            <p class="auth-subtitle">Connectez-vous à votre compte</p>
        </div>

        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert-erreur"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <form action="/operateur/verifier" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label>Identifiant</label>
                <input type="text" name="identifiant" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password" name="mot_de_passe" class="form-control" required>
            </div>
            <button type="submit" class="btn-brand w-100">Se connecter</button>
        </form>
    </div>
</div>
</body>
</html>