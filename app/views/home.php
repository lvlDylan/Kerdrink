<?php
require_once ROOT . "app/views/partials/head.php";
require_once ROOT . "app/views/partials/navbar.php";
?>
<main class="container py-5">
    <header class="text-center py-5">
        <h1 class="display-2 fw-black text-premium mb-2">KerDrink</h1>

        <?php if (isset($_SESSION["user"])): ?>
            <h2 class="display-6 mb-2">Bienvenue dans notre cave, <span class="text-premium"><?= $_SESSION["user"]["prenom"] ?></span></h2>
        <?php endif; ?>

        <p class="lead opacity-50 text-uppercase tracking-widest small"></p>
    </header>

    <div class="row g-4 justify-content-center">
        <?php /** @var array $products**/ foreach ($products as $p): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <article class="card product-card h-100 shadow-none">
                    <div class="p-4 text-center position-relative">
                        <img src="/img/<?= $p["nomImage"] ?>" class="img-fluid img-product" style="height:200px;" alt="<?= $p["nomProduit"] ?>">
                        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-n2">
                            <span class="badge bg-black border border-secondary px-3 py-2 rounded-pill">
                                <?= number_format($p["prixUnitaire"], 0, '.', ' ') ?> €
                            </span>
                        </div>
                    </div>
                    <div class="card-body pt-4 text-center">
                        <h3 class="h5 fw-bold mb-3"><?= $p["nomProduit"] ?></h3>
                        <p class="small opacity-50 mb-4"><?= $p["descriptif"] ?></p>
                        <a href="/?page=detail&id=<?= $p["numProduit"] ?>" class="btn-premium w-100 text-decoration-none d-block stretched-link">
                            DÉCOUVRIR <i class="bi bi-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
</main>