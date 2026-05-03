<?php /** @var array $product */ /** @var array $category */?>
<main class="container py-5">
    <div class="row align-items-center min-vh-75 g-5">
        <div class="col-lg-7 text-center">
            <div class="position-relative">
                <img src="/img<?= $product["nomImage"] ?>" class="img-fluid floating img-product w-75"
                     alt="<?= $product["nomProduit"] ?>">
            </div>
        </div>

        <div class="col-lg-5">
            <div class="mb-5">
                <nav class="mb-4">
                    <a href="/?page=produits" class="text-decoration-none small fw-bold" style="color: var(--acc)">
                        <i class="bi bi-chevron-left"></i> CATALOGUES
                    </a>
                </nav>
                <h6 class="text-uppercase fw-bold mb-2"><?= $category["libelleCategorie"] ?></h6>
                <h1 class="display-3 fw-bold mb-3"><?= $product["nomProduit"] ?></h1>
                <p class="lead opacity-50 mb-4"><?= $product["descriptif"] ?></p>
            </div>

            <div class="card p-4 rounded-4 shadow-lg border-0" style="background: var(--bg-card);">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <small class="d-block mb-1 opacity-50"
                               style="color: var(--txt); font-size: 0.7rem; letter-spacing: 1px;">PRIX DE LA BOUTEILLE</small>
                        <span class="h1 fw-bold mb-0"
                              style="color: var(--acc);"><?= number_format($product["prixUnitaire"], 2, '.', ' ') ?> €</span>
                    </div>
                    <div class="text-end">
                        <small class="d-block opacity-50 mb-1"
                               style="color: var(--txt); font-size: 0.7rem;">STOCKS</small>
                        <span class="badge border px-3 py-2"
                              style="background: var(--acc-soft); color: var(--acc); border-color: var(--acc) !important;">
                <?= $product["stock"] ?> RESTANTES
            </span>
                    </div>
                </div>

                <form action="#" method="POST">
                    <input type="hidden" name="id" value="<?= $product["numProduit"] ?>">

                    <div class="d-flex justify-content-between align-items-center mb-4 p-2 rounded-3 border"
                         style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="small opacity-50 fw-bold ms-2" style="color: var(--txt); letter-spacing: 1px;">BOUTEILLES</span>
                        <div class="d-flex align-items-center border rounded-2"
                             style="background: var(--bg-card); border-color: var(--border) !important;">
                            <button type="button" class="btn btn-sm border-0 px-2"
                                    style="color: var(--acc);"
                                    onclick="this.parentNode.querySelector('input').stepDown()">-
                            </button>

                            <label>
                                <input type="number" name="qty"
                                       class="form-control bg-transparent border-0 text-center fw-bold p-0"
                                       value="1" min="1" max="<?= $product["stock"] ?>"
                                       style="color: var(--txt); width: 35px; font-size: 0.9rem;">
                            </label>

                            <button type="button" class="btn btn-sm border-0 px-2"
                                    style="color: var(--acc);"
                                    onclick="this.parentNode.querySelector('input').stepUp()">+
                            </button>
                        </div>
                    </div>

                    <button class="btn w-100 py-3 fw-bold rounded-3 text-uppercase shadow-sm"
                            style="background: var(--acc); color: white; border: none; transition: 0.3s;">
                        COMMANDER <i class="bi bi-bag-plus ms-2"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>