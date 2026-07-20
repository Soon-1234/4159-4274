<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Situation des gains</h1>

<form class="form-ajout" action="/operateur/gains" method="get">
    <label>Du <input type="date" name="date_debut" value="<?= esc($dateDebut) ?>"></label>
    <label>Au <input type="date" name="date_fin" value="<?= esc($dateFin) ?>"></label>
    <button type="submit" class="btn">Filtrer</button>
</form>

<h2 style="margin-top: 25px; font-size: 16px; color: #27ae60;">
    Notre gain (frais) : <?= number_format($totalGainsNous, 0, ',', ' ') ?> Ar
</h2>

<table>
    <thead>
        <tr>
            <th>Type d'opération</th>
            <th>Nombre d'opérations</th>
            <th>Total des frais</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($gainsParType as $ligne): ?>
            <tr>
                <td><?= esc($ligne['nom']) ?></td>
                <td><?= $ligne['nb_operations'] ?></td>
                <td><?= number_format($ligne['total_frais'], 0, ',', ' ') ?> Ar</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($gainsParType)): ?>
    <p>Aucune opération sur cette période.</p>
<?php endif; ?>

<h2 style="margin-top: 30px; font-size: 16px; color: #c0392b;">
    Reversé aux autres opérateurs (commission) : <?= number_format($totalCommission, 0, ',', ' ') ?> Ar
</h2>
<p style="font-size: 13px; color: #888;">
    Détail par opérateur disponible sur la page « Montants envoyés par opérateur ».
</p>

<?= $this->endSection() ?>