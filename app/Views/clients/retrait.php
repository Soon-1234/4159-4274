<!DOCTYPE html>
<html>
<head>
    <title>Retrait</title>
</head>
<body>
<div class="container mt-5">
    <h2>Effectuer un retrait</h2>

    <?php if (session()->getFlashdata('erreur')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
    <?php endif; ?>

    <p>Solde actuel : <?= number_format($client['solde'], 0, ',', ' ') ?> Ar</p>

    <form action="/client/retrait/valider" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Montant à retirer</label>
            <input type="number" name="montant" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-warning">Confirmer le retrait</button>
        <a href="/client/dashboard" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html>