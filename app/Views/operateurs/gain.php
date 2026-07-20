<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Situation des gains</h1>

<form class="form-ajout" action="/operateur/gains" method="get">
    <label>Du <input type="date" name="date_debut" value="<?= esc($dateDebut) ?>"></label>
    <label>Au <input type="date" name="date_fin" value="<?= esc($dateFin) ?>"></label>
    <button type="submit" class="btn">Filtrer</button>
</form>

<h2 style="margin-top: 25px; font-size: 16px;">Total global : <?= number_format($totalGlobal, 0, ',', ' ') ?> Ar</h2>

<table>
    <thead>
        <tr>
            <th>Type d'opération</th>
            <th>Nombre d'opérations</th>
            <th>Total des frais</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($parType as $ligne): ?>
            <tr>
                <td><?= esc($ligne['nom']) ?></td>
                <td><?= $ligne['nb_operations'] ?></td>
                <td><?= number_format($ligne['total_frais'], 0, ',', ' ') ?> Ar</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($parType)): ?>
    <p>Aucune opération sur cette période.</p>
<?php endif; ?>

<?= $this->endSection() ?>