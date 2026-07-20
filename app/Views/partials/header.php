<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Mobile Money') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
<?php if (($variant ?? 'app') === 'app'): ?>
    <div class="topbar">
        <div class="brand">
            <span class="brand-mark">MM</span>
            <span>Mobile Money</span>
        </div>
        <div class="d-flex align-items-center">
            <span class="user-chip"><?= esc($client['numero'] ?? '') ?></span>
            <a href="/auth/logout" class="logout-link">Déconnexion</a>
        </div>
    </div>
    <div class="page-wrap">
<?php else: ?>
    <div class="auth-wrap">
<?php endif; ?>