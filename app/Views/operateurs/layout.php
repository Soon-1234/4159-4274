<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titre ?? 'Espace Opérateur' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f4f4;
        }

        nav {
            background: #2c3e50;
            padding: 15px 30px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-size: 14px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            font-size: 13px;
            text-transform: uppercase;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            background: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }

        .btn-danger {
            background: #c0392b;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-erreur {
            background: #fdecea;
            color: #c0392b;
        }

        .alert-succes {
            background: #eafaf1;
            color: #27ae60;
        }

        form.inline {
            display: inline;
        }

        .form-ajout {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-ajout input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="/operateur/prefixes">Préfixes</a>
        <a href="/operateur/types-operation">Types d'opération</a>
        <a href="/operateur/clients">Comptes clients</a>
        <a href="/operateur/gains">Situation des gains</a>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert alert-erreur"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('succes')): ?>
            <div class="alert alert-succes"><?= session()->getFlashdata('succes') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('contenu') ?>
    </div>
</body>

</html>