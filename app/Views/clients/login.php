<!DOCTYPE html>
<html>
<head>
    <title>Mobile Money - Connexion</title>
</head>
<body>
<div class="container">
    <h2>Connexion</h2>

    <?php if (session()->getFlashdata('erreur')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
    <?php endif; ?>

    <form action="/auth/verifier" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Numéro de téléphone</label>
            <input type="text" name="numero" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>
</div>
</body>
</html>