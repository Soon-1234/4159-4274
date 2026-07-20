<!DOCTYPE html>
<html>
<head>
    <title>Mon compte</title>
</head>
<body>
<div class="container mt-5">
    <h2>Bienvenue, <?= esc($client['numero']) ?></h2>

    <?php if (session()->getFlashdata('succes')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('succes') ?></div>
<?php endif; ?>

    <div class="alert alert-info">
        Solde actuel : <strong><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</strong>
    </div>

    <a href="/client/depot" class="btn btn-success">Dépôt</a>
    <a href="/client/retrait" class="btn btn-warning">Retrait</a>
    <a href="/client/transfert" class="btn btn-primary">Transfert</a>
    <a href="/client/historique" class="btn btn-secondary">Historique</a>
    <a href="/auth/logout" class="btn btn-outline-danger">Déconnexion</a>
</div>
</body>
</html>