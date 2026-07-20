<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Situation des comptes clients</h1>

<form class="form-ajout" action="/operateur/clients" method="get">
    <input type="text" name="numero" placeholder="Rechercher par numéro" value="<?= esc($recherche ?? '') ?>">
    <button type="submit" class="btn">Rechercher</button>
    <?php if (!empty($recherche)): ?>
        <a href="/operateur/clients" class="btn btn-danger">Réinitialiser</a>
    <?php endif; ?>
</form>

<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Solde</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $c): ?>
            <tr>
                <td><?= esc($c['numero']) ?></td>
                <td><?= number_format($c['solde'], 0, ',', ' ') ?> Ar</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (empty($clients)): ?>
    <p>Aucun client trouvé.</p>
<?php endif; ?>

<?= $this->endSection() ?>