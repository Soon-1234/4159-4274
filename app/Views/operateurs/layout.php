<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titre ?? 'Espace Opérateur') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="admin-nav">
        <div class="brand"><span class="brand-mark">AS</span> <a href="/operateur/dashboard"> Espace Opérateur </a></div>
        <a href="/operateur/prefixes">Préfixes</a>
        <a href="/operateur/types-operation">Types d'opération</a>
        <a href="/operateur/clients">Comptes clients</a>
        <a href="/operateur/gains">Situation des gains</a>
    </div>

    <div class="container">
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert-erreur"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('succes')): ?>
            <div class="alert-succes"><?= session()->getFlashdata('succes') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('contenu') ?>
    </div>

    <script src="/assets/js/script.js"></script>
</body>

</html>