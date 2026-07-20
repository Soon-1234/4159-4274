<?= view('partials/header', ['title' => 'Envoi multiple', 'client' => $client]) ?>

<h1 class="page-title">Envoi multiple</h1>

<?php if (session()->getFlashdata('erreur')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('erreur') ?></div>
<?php endif; ?>

<div class="balance-card balance-card-sm">
    <div class="label">Solde actuel</div>
    <div class="amount"><?= number_format($client['solde'], 0, ',', ' ') ?> Ar</div>
</div>

<div class="card-panel">
    <p class="text-muted" style="font-size:0.85rem;">Le montant total sera divisé à parts égales entre les destinataires
        ajoutés.</p>

    <form action="/client/envoi-multiple/valider" method="post" data-confirm="Confirmer cet envoi multiple ?">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label>Montant total à répartir</label>
            <input type="number" name="montant_total" class="form-control" required min="1">
        </div>

        <div id="listeDestinataires">
            <div class="mb-2 d-flex gap-2 ligne-destinataire">
                <input type="text" name="numeros[]" class="form-control" placeholder="Numéro destinataire" required>
            </div>
            <div class="mb-2 d-flex gap-2 ligne-destinataire">
                <input type="text" name="numeros[]" class="form-control" placeholder="Numéro destinataire" required>
            </div>
        </div>

        <button type="button" id="btnAjouterDestinataire" class="link-muted mb-3"
            style="background:none;border:none;cursor:pointer;padding:0;">
            + Ajouter un destinataire
        </button>

        <button type="submit" class="btn btn-brand w-100">Confirmer l'envoi multiple</button>
        <a href="/client/dashboard" class="link-muted d-block text-center mt-3">Annuler</a>
    </form>
</div>

<?= view('partials/footer') ?>

<script>
    document.getElementById('btnAjouterDestinataire').addEventListener('click', function () {
        const liste = document.getElementById('listeDestinataires');
        const ligne = document.createElement('div');
        ligne.className = 'mb-2 d-flex gap-2 ligne-destinataire';
        ligne.innerHTML = `
        <input type="text" name="numeros[]" class="form-control" placeholder="Numéro destinataire" required>
        <button type="button" class="btn-retirer" style="border-radius:10px;border:1.5px solid #F1B6B0;background:#fff;color:#D64541;padding:0 0.9rem;">×</button>
    `;
        liste.appendChild(ligne);
    });

    document.getElementById('listeDestinataires').addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-retirer')) {
            const lignes = document.querySelectorAll('.ligne-destinataire');
            if (lignes.length > 2) {
                e.target.closest('.ligne-destinataire').remove();
            }
        }
    });
</script>