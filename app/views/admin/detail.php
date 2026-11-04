<?php
/** @var array $orderInfo */
/** @var array $contains */
?>

<main class="container py-5">
    <a href="/admin" class="text-decoration-none text-premium small text-uppercase tracking-widest mb-5 d-block">
        <i class="bi bi-arrow-left me-2"></i> Retour à l'administration
    </a>

    <div class="row g-5">
        <div class="col-lg-8">
            <h1 class="h2 fw-black text-premium text-uppercase mb-4">Contenu de la commande</h1>

            <div class="table-responsive">
                <table class="table table-borderless align-middle">
                    <thead>
                    <tr class="small text-uppercase border-bottom border-secondary">
                        <th class="py-3 fw-normal">Article</th>
                        <th class="py-3 fw-normal text-center">Prix</th>
                        <th class="py-3 fw-normal text-center">Qté</th>
                        <th class="py-3 fw-normal text-end">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalGeneral = 0;
                    foreach ($contains as $item):
                        $sousTotal = $item['prixUnitaire'] * $item['quantite'];
                        $totalGeneral += $sousTotal;
                        ?>
                        <tr class="border-bottom border-light">
                            <td class="py-4">
                                <span class="fw-bold d-block"><?= $item['nomProduit'] ?></span>
                            </td>
                            <td class="py-4 text-center"><?= number_format($item['prixUnitaire'], 2, ',', ' ') ?> €</td>
                            <td class="py-4 text-center">x<?= $item['quantite'] ?></td>
                            <td class="py-4 text-end fw-bold"><?= number_format($sousTotal, 2, ',', ' ') ?> €</td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 bg-light p-4 rounded-0">
                <h2 class="h5 fw-bold text-uppercase mb-4">Résumé</h2>

                <div class="d-flex justify-content-between mb-2">
                    <span class="opacity-50">Client</span>
                    <span class="fw-bold"><?= $orderInfo['nom'] ?> <?= $orderInfo['prenom'] ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="opacity-50">Date</span>
                    <span><?= date('d/m/Y', strtotime($orderInfo['dateCommande'])) ?></span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="opacity-50">Statut</span>
                    <span class="badge bg-black rounded-pill"><?= $orderInfo['libelleStatut'] ?></span>
                </div>

                <hr class="border-secondary">

                <div class="d-flex justify-content-between align-items-center my-4">
                    <span class="h4 mb-0 fw-black text-premium">TOTAL</span>
                    <span class="h3 mb-0 fw-black"><?= number_format($totalGeneral, 2, ',', ' ') ?> €</span>
                </div>

                <?php if ($orderInfo['idStatut'] === 'ENC'): ?>
                    <form action="/admin-update-statut-exe" method="POST">
                        <input type="hidden" name="noCommande" value="<?= $orderInfo['noCommande'] ?>">
                        <button type="submit" class="btn-premium w-100 border-0 py-3 fw-bold text-uppercase">
                            Valider l'expédition <i class="bi bi-truck ms-2"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>