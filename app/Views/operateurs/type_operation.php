<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Types d'opération</h1>

<form class="form-ajout" action="/operateur/types-operation/store" method="post">
    <?= csrf_field() ?>
    <input type="text" name="nom" placeholder="Ex: PAIEMENT" required>
    <button type="submit" class="btn">Ajouter</button>
</form>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($types as $t): ?>
            <tr>
                <td><?= esc($t['nom']) ?></td>
                <td>
                    <a class="btn" href="/operateur/baremes/<?= $t['id'] ?>">Barèmes</a>
                    <a class="btn" href="/operateur/types-operation/edit/<?= $t['id'] ?>">Modifier</a>
                    <form class="inline" action="/operateur/types-operation/delete/<?= $t['id'] ?>" method="post" onsubmit="return confirm('Supprimer ce type ?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>