<?= $this->extend('operateurs/layout') ?>

<?= $this->section('contenu') ?>

<div class="container-fluid p-4">
    <h1 class="mb-4">Situation des gains et commissions</h1>

    <!-- Formulaire de filtrage -->
    <form class="d-flex gap-3 align-items-center mb-4 p-3 bg-light rounded border" action="/operateur/gains" method="get">
        <div>
            <label for="date_debut" class="form-label mb-0">Du</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control w-auto" value="<?= esc($dateDebut ?? date('Y-m-d')) ?>">
        </div>
        <div>
            <label for="date_fin" class="form-label mb-0">Au</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control w-auto" value="<?= esc($dateFin ?? date('Y-m-d')) ?>">
        </div>
        <button type="submit" class="btn btn-primary px-4">Filtrer</button>
    </form>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0 text-white">Notre gain (frais)</h2>
            <span class="fs-4 fw-bold"><?= number_format($totalGainsNous ?? 0, 0, ',', ' ') ?> Ar</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Type d'opération</th>
                            <th class="text-center">Nombre d'opérations</th>
                            <th class="text-end">Total des frais</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($gainsParType)): ?>
                            <?php foreach ($gainsParType as $ligne): ?>
                                <tr>
                                    <td><?= esc($ligne['nom']) ?></td>
                                    <td class="text-center"><?= $ligne['nb_operations'] ?></td>
                                    <td class="text-end fw-bold text-success">
                                        <?= number_format($ligne['total_frais'], 0, ',', ' ') ?> Ar
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Aucune opération interne sur cette période.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
            <h2 class="h5 mb-0 text-white">Reversé aux autres opérateurs (commission)</h2>
            <span class="fs-4 fw-bold"><?= number_format($totalCommission ?? 0, 0, ',', ' ') ?> Ar</span>
        </div>

        <div class="card-body">
            <h5 class="text-muted mb-3">Détail par opérateur externe :</h5>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Opérateur Externe</th>
                            <th class="text-center">Nombre de transferts</th>
                            <th class="text-end">Montant commission reversée</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($resultats)): ?>
                            <?php foreach ($resultats as $r): ?>
                                <tr>
                                    <td class="fw-bold"><?= esc($r['operateur']) ?></td>
                                    <td class="text-center"><?= $r['nb_transferts'] ?></td>
                                    <td class="text-end fw-bold text-danger">
                                        <?= number_format($r['total_commission'], 0, ',', ' ') ?> Ar
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    Aucun transfert externe sur cette période.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="2" class="text-end fw-bold">TOTAL GÉNÉRAL ENVOYÉ :</td>
                            <td class="text-end fw-bold fs-5 text-danger">
                                <?= number_format($totalGeneral ?? 0, 0, ',', ' ') ?> Ar
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>