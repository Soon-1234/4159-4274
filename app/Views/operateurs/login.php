<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion Opérateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            width: 320px;
        }

        h1 {
            font-size: 18px;
            color: #2c3e50;
            margin-top: 0;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .alert-erreur {
            background: #fdecea;
            color: #c0392b;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 12px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="box">
        <h1>Connexion Opérateur</h1>

        <?php if (session()->getFlashdata('erreur')): ?>
            <div class="alert-erreur"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <form action="/operateur/verifier" method="post">
            <?= csrf_field() ?>
            <input type="text" name="identifiant" placeholder="Identifiant" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>

</html>