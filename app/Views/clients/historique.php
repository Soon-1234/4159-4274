<!DOCTYPE html>
<html>
<head>
    <title>Historique</title>
</head>
<body>
<div class="container mt-5">
    <h2>Historique des opérations</h2>
    <p>Solde actuel : <?= number_format($client['solde'], 0, ',', ' ') ?> Ar</p>

    <table class="table table-striped">
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
                <td><?= esc($op['type_nom']) ?></td>
                <td><?= number_format($op['montant'], 0, ',', ' ') ?> Ar</td>
                <td><?= number_format($op['frais'], 0, ',', ' ') ?> Ar</td>
                <td><?= $op['destinataire_numero'] ? esc($op['destinataire_numero']) : '-' ?></td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($operations)): ?>
            <tr>
                <td colspan="5" class="text-center">Aucune opération pour le moment</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="/client/dashboard" class="btn btn-secondary">Retour</a>
</div>
</body>
</html>