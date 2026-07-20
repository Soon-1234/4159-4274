<?= view('partials/header', ['title' => 'Historique', 'client' => $client]) ?>

<h1 class="page-title">Historique des opérations</h1>

<div class="balance-card balance-card-sm">
    <div class="label">Solde actuel</div>
    <div class="amount"><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="card-panel table-panel">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Frais</th>
                    <th>Destinataire</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($operations as $op): ?>
                <tr>
                    <td><?= esc($op['date_operation']) ?></td>
                    <td><span class="badge-type"><?= esc($op['type_nom']) ?></span></td>
                    <td><?= number_format($op['montant'], 0, ',', ' ') ?> Ar</td>
                    <td><?= number_format($op['frais'], 0, ',', ' ') ?> Ar</td>
                    <td><?= $op['destinataire_numero'] ? esc($op['destinataire_numero']) : '-' ?></td>
                </tr>
                <?php endforeach; ?>

                <?php if (empty($operations)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Aucune opération pour le moment</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<a href="/client/dashboard" class="link-muted d-block text-center mt-3">Retour au tableau de bord</a>

<?= view('partials/footer') ?>