<?php /** @var array $cart */ ?>
<main class="container py-5">
    <h2 class="fw-bold mb-5">Mon Panier</h2>

    <?php if (empty($cart['produits'])): ?>
        <div class="text-center py-5">
            <p class="opacity-50">Votre panier est vide.</p>
        </div>
    <?php else: ?>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php $total = 0; ?>
                    <?php foreach ($cart['produits'] as $item): ?>
                        <?php
                        $st = $item['prix'] * $item['qte'];
                        $total += $st;
                        ?>
                        <li class="list-group-item d-flex justify-content-between p-4">
                            <div>
                                <h6 class="fw-bold mb-0"><?= htmlspecialchars($item['nom']) ?></h6>
                                <small class="text-muted"><?= $item['qte'] ?> x <?= number_format($item['prix'], 2) ?> €</small>
                            </div>
                            <div class="text-end">
                                <p class="fw-bold mb-0"><?= number_format($st, 2) ?> €</p>
                                <form action="/retirer-panier-exe" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                                    <input type="hidden" name="id" value="<?= $item['numProduit'] ?>">
                                    <button type="submit" class="btn btn-link text-danger p-0 small text-decoration-none border-0 bg-transparent">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-footer p-4 bg-white border-top-0 d-flex justify-content-between align-items-center">
                <span class="fw-bold">TOTAL</span>
                <span class="fs-3 fw-bold" style="color: var(--acc)"><?= number_format($total, 2) ?> €</span>
            </div>
        </div>

        <div class="d-grid mt-4">
            <a href="?page=valider-panier-exe" class="btn btn-lg text-white rounded-pill" style="background-color: var(--acc)">
                Confirmer la commande
            </a>
        </div>
    <?php endif; ?>
</main>