<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Montants envoyés à chaque opérateur</h1>

<form class="form-ajout" action="/operateur/envois-operateurs" method="get">
    <label>Du <input type="date" name="date_debut" value="<?= esc($dateDebut) ?>"></label>
    <label>Au <input type="date" name="date_fin" value="<?= esc($dateFin) ?>"></label>
    <button type="submit" class="btn">Filtrer</button>
</form>

<h2 style="margin-top: 25px; font-size: 16px;">
    Total envoyé sur la période : <?= number_format($totalGeneral, 0, ',', ' ') ?> Ar
</h2>

<table>
    <thead>
        <tr>
            <th>Opérateur</th>
            <th>Nombre de transferts</th>
            <th>Montant envoyé (commission)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultats as $r): ?>
            <tr>
                <td><?= esc($r['operateur']) ?></td>
                <td><?= $r['nb_transferts'] ?></td>
                <td><?= number_format($r['total_commission'], 0, ',', ' ') ?> Ar</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($resultats)): ?>
    <p>Aucun transfert externe sur cette période.</p>
<?php endif; ?>

<?= $this->endSection() ?>