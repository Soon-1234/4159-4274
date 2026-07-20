<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Barèmes de frais — <?= esc($type['nom']) ?></h1>

<form class="form-ajout" action="/operateur/baremes/<?= $type['id'] ?>/store" method="post">
    <?= csrf_field() ?>
    <input type="number" name="montant_min" placeholder="Montant min" required>
    <input type="number" name="montant_max" placeholder="Montant max" required>
    <input type="number" name="frais" placeholder="Frais" required>
    <button type="submit" class="btn">Ajouter une tranche</button>
</form>

<table>
    <thead>
        <tr>
            <th>Montant min</th>
            <th>Montant max</th>
            <th>Frais</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($baremes as $b): ?>
            <tr>
                <td><?= number_format($b['montant_min'], 0, ',', ' ') ?> Ar</td>
                <td><?= number_format($b['montant_max'], 0, ',', ' ') ?> Ar</td>
                <td>
                    <form class="inline" action="/operateur/baremes/update/<?= $b['id'] ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="number" name="frais" value="<?= $b['frais'] ?>" style="width: 80px;">
                        <button type="submit" class="btn">Modifier</button>
                    </form>
                </td>
                <td>
                    <form class="inline" action="/operateur/baremes/delete/<?= $b['id'] ?>" method="post" onsubmit="return confirm('Supprimer cette tranche ?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/operateur/types-operation">← Retour aux types</a>

<?= $this->endSection() ?>