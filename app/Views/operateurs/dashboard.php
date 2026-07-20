<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<h1>Tableau de bord opérateur</h1>
<p>Bienvenue, <?= esc(session()->get('identifiant')) ?>.</p>

<ul>
    <li><a href="/operateur/prefixes">Gérer les préfixes</a></li>
    <li><a href="/operateur/types-operation">Gérer les types d'opération</a></li>
    <li><a href="/operateur/clients">Voir les comptes clients</a></li>
    <li><a href="/operateur/gains">Voir la situation des gains</a></li>
    <li><a href="/operateur/autres-operateurs">Gérer les autres opérateurs</a></li>
    <li><a href="/operateur/envois-operateurs">Montants envoyés par opérateur</a></li>
</ul>

<?= $this->endSection() ?>