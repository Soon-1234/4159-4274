<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Configuration des préfixes</h1>

<form class="form-ajout" action="/operateur/prefixes/store" method="post">
    <?= csrf_field() ?>
    <input type="text" name="prefixe" placeholder="Ex: 033" maxlength="10" required>
    <button type="submit" class="btn">Ajouter</button>
</form>

<table>
    <thead>
        <tr>
            <th>Préfixe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($prefixes as $p): ?>
            <tr>
                <td><?= esc($p['prefixe']) ?></td>
                <td>
                    <form class="inline" action="/operateur/prefixes/delete/<?= $p['id'] ?>" method="post" onsubmit="return confirm('Supprimer ce préfixe ?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>