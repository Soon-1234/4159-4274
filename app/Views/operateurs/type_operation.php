<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Types d'opération</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($types as $t): ?>
            <tr>
                <td><?= esc($t['nom']) ?></td>
                <td>
                    <a class="btn" href="/operateur/baremes/<?= $t['id'] ?>">Gérer les barèmes</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>