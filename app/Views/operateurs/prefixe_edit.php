<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Modifier le préfixe</h1>

<form action="/operateur/prefixes/update/<?= $prefixe['id'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="text" name="prefixe" value="<?= esc($prefixe['prefixe']) ?>" required>
    <button type="submit" class="btn">Enregistrer</button>
</form>

<a href="/operateur/prefixes">← Retour</a>

<?= $this->endSection() ?>