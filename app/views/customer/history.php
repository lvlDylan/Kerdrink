<?php /** @var array $orders */ ?>
<main class="container py-5">

    <?php if ($flash = Helper::getFlash()): ?>
        <div class="alert alert-dismissible fade show d-flex align-items-center p-3 mb-4 rounded-3 border-start border-4 shadow-sm" id="flash-toast"
             style="background-color: #e6f4ea; border-color: #198754 !important;">
            <i class="bi bi-check-circle-fill me-3" style="color: #198754;"></i>
            <div style="color: #0f5132; font-size: 0.85rem; font-weight: 500;">
                <?= $flash["message"] ?>
            </div>
        </div>
    <?php endif; ?>

    <h2 class="fw-bold mb-5">Mon historique de commandes</h2>

    <?php if (empty($orders)): ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <p class="mt-3 opacity-50">Vous n'avez pas encore passé de commande.</p>
            <a href="/produits" class="text-decoration-none small fw-bold" style="color: var(--acc)">Découvrir nos produits</a>
        </div>
    <?php else: ?>

        <?php foreach ($orders as $idCmd => $data): ?>
        <?php
            $badgeColor = match ($data['idStatut'] ?? '') {
                'PAY' => 'info',
                'ENC' => 'warning',
                'ENV' => 'primary',
                'LIV' => 'success',
                'ANN' => 'danger',
                default => 'secondary'
            };
            ?>

            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase">Commande</span>
                        <h5 class="mb-0 fw-bold">#<?= $idCmd ?></h5>
                    </div>
                    <div class="text-end">
                        <p class="small text-muted mb-1"><?= date('d/m/Y', strtotime($data['date'])) ?></p>
                        <span class="badge rounded-pill bg-<?= $badgeColor ?>-subtle text-<?= $badgeColor ?> border border-<?= $badgeColor ?>-subtle text-uppercase">
                            <?= htmlspecialchars($data['statut']) ?>
                        </span>
                    </div>
                </div>

                <div class="card-body py-0">
                    <ul class="list-group list-group-flush">
                        <?php $totalCommande = 0; ?>
                        <?php foreach ($data['produits'] as $produit): ?>
                            <?php
                            $sousTotal = $produit['prix'] * $produit['qte'];
                            $totalCommande += $sousTotal;
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3 px-0">
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= htmlspecialchars($produit['nom']) ?></h6>
                                    <small class="text-muted">
                                        <?= number_format($produit['prix'], 2) ?> € x <?= $produit['qte'] ?>
                                    </small>
                                </div>
                                <span class="fw-semibold"><?= number_format($sousTotal, 2) ?> €</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card-footer bg-light border-top-0 py-3 d-flex justify-content-between align-items-center px-4">
                    <span class="fw-bold text-uppercase small opacity-75">Total de la commande</span>
                    <span class="fs-5 fw-bold" style="color: var(--acc)">
                        <?= number_format($totalCommande, 2) ?> €
                    </span>
                </div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</main>