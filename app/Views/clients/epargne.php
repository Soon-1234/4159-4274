<?= view('partials/header', ['title' => 'Mon épargne', 'client' => $client]) ?>

<h1 class="page-title">Mon épargne</h1>

<?php if (session()->getFlashdata('erreur')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('succes')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('succes') ?></div>
<?php endif; ?>

<div class="balance-card">
    <div class="label">Solde épargne</div>
    <div class="amount"><?= number_format($client['epargne_solde'], 0, ',', ' ') ?> Ar</div>
    <div class="owner">Solde principal : <?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="card-panel mb-3">
    <h2 class="section-title">Pourcentage d'épargne</h2>
    <p class="link-muted" style="font-size:0.85rem;">Ce pourcentage est prélevé automatiquement sur chaque transfert que vous recevez.</p>
    <form action="/client/epargne/pourcentage" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Pourcentage (%)</label>
            <input type="number" name="pourcentage" class="form-control" min="0" max="100" value="<?= esc($client['epargne_pourcentage']) ?>" required>
        </div>
        <button type="submit" class="btn-brand w-100">Enregistrer</button>
    </form>
</div>

<div class="card-panel">
    <h2 class="section-title">Transférer vers mon solde</h2>
    <form action="/client/epargne/transferer" method="post">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Montant à transférer</label>
            <input type="number" name="montant" class="form-control" required min="1" max="<?= $client['epargne_solde'] ?>">
        </div>
        <button type="submit" class="btn-brand w-100">Transférer vers mon solde principal</button>
    </form>
</div>

<a href="/client/dashboard" class="link-muted d-block text-center mt-3">Retour au tableau de bord</a>

<?= view('partials/footer') ?>