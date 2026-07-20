<!DOCTYPE html>
<html>
<head>
    <title>Transfert</title>
</head>
<body>
<div class="container mt-5">
    <h2>Effectuer un transfert</h2>

    <?php if (session()->getFlashdata('erreur')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
    <?php endif; ?>

    <p>Solde actuel : <?= number_format($client['solde'], 0, ',', ' ') ?> Ar</p>

    <form action="/client/transfert/valider" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Numéro du destinataire</label>
            <input type="text" name="numero_destinataire" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Montant à transférer</label>
            <input type="number" name="montant" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-primary">Confirmer le transfert</button>
        <a href="/client/dashboard" class="btn btn-secondary">Annuler</a>
    </form>
</div>
</body>
</html> 