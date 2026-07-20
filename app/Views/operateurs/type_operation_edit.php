<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Modifier le type d'opération</h1>

<form action="/operateur/types-operation/update/<?= $type['id'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" name="nom" value="<?= esc($type['nom']) ?>" required>
    <button type="submit" class="btn">Enregistrer</button>
</form>

<a href="/operateur/types-operation">← Retour</a>

<?= $this->endSection() ?>