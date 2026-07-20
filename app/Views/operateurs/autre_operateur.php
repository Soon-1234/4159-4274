<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Autres opérateurs</h1>

<h2 style="font-size: 15px; margin-top: 20px;">Commission sur transferts externes</h2>
<form class="form-ajout" action="/operateur/autres-operateurs/commission" method="post">
    <?= csrf_field() ?>
    <input type="number" step="0.01" name="pourcentage" value="<?= esc($commission['pourcentage'] ?? 0) ?>" required>
    <span>%</span>
    <button type="submit" class="btn">Mettre à jour</button>
</form>

<h2 style="font-size: 15px; margin-top: 25px;">Liste des opérateurs</h2>
<form class="form-ajout" action="/operateur/autres-operateurs/store" method="post">
    <?= csrf_field() ?>
    <input type="text" name="nom" placeholder="Ex: Airtel" required>
    <button type="submit" class="btn">Ajouter un opérateur</button>
</form>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($operateurs as $op): ?>
            <tr>
                <td><?= esc($op['nom']) ?></td>
                <td>
                    <a class="btn" href="/operateur/autres-operateurs/prefixes/<?= $op['id'] ?>">Gérer les préfixes</a>
                    <form class="inline" action="/operateur/autres-operateurs/delete/<?= $op['id'] ?>" method="post" onsubmit="return confirm('Supprimer cet opérateur ?');">
                        <?= csrf_field() ?>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>