<?= view('partials/header', ['title' => 'Mon compte', 'client' => $client]) ?>

<?php if (session()->getFlashdata('succes')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('succes') ?></div>
<?php endif; ?>

<div class="balance-card">
    <div class="label">Solde disponible</div>
    <div class="amount"><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
    <div class="owner">Bienvenue, <?= esc($client['numero']) ?></div>
</div>

<div class="card-panel">
    <h2 class="section-title">Opérations</h2>
    <div class="actions-grid">
        <a href="/client/depot" class="action-btn"><span class="action-icon">＋</span>Dépôt</a>
        <a href="/client/retrait" class="action-btn"><span class="action-icon">－</span>Retrait</a>
        <a href="/client/transfert" class="action-btn"><span class="action-icon">⇄</span>Transfert</a>
        <a href="/client/historique" class="action-btn"><span class="action-icon">≡</span>Historique</a>
    </div>
</div>

<?= view('partials/footer') ?>