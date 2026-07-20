<?= view('partials/header', ['title' => 'Retrait', 'client' => $client]) ?>

<h1 class="page-title">Effectuer un retrait</h1>

<?php if (session()->getFlashdata('erreur')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
<?php endif; ?>

<div class="balance-card balance-card-sm">
    <div class="label">Solde actuel</div>
    <div class="amount"><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="card-panel">
    <form action="/client/retrait/valider" method="post" data-confirm="Confirmer ce retrait ?">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Montant à retirer</label>
            <input type="number" name="montant" class="form-control" required min="1">
        </div>
        <button type="submit" class="btn btn-brand w-100">Confirmer le retrait</button>
        <a href="/client/dashboard" class="link-muted d-block text-center mt-3">Annuler</a>
    </form>
</div>

<?= view('partials/footer') ?>