<?= view('partials/header', ['title' => 'Transfert', 'client' => $client]) ?>

<h1 class="page-title">Effectuer un transfert</h1>

<?php if (session()->getFlashdata('erreur')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
<?php endif; ?>

<div class="balance-card balance-card-sm">
    <div class="label">Solde actuel</div>
    <div class="amount"><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="card-panel">
    <form action="/client/transfert/valider" method="post" data-confirm="Confirmer ce transfert ?">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Numéro du destinataire</label>
            <input type="text" name="numero_destinataire" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Montant à transférer</label>
            <input type="number" name="montant" class="form-control" required min="1">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="inclure_frais_retrait" id="inclureFraisRetrait"
                value="1">
            <label class="form-check-label" for="inclureFraisRetrait">
                Inclure les frais de retrait pour le destinataire
            </label>
        </div>

        <button type="submit" class="btn btn-brand w-100">Confirmer le transfert</button>
        <a href="/client/dashboard" class="link-muted d-block text-center mt-3">Annuler</a>
    </form>
</div>

<?= view('partials/footer') ?>