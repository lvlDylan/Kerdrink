<?php
require_once ROOT . "app/views/partials/head.php";
require_once ROOT . "app/views/partials/navbar.php";
$pageTitle = "Oups ! Page introuvable";
?>

<main class="container py-5">
    <div class="row min-vh-75 align-items-center justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 text-center">

            <div class="mb-4">
                <span class="display-1 fw-black opacity-50">404</span>
            </div>

            <header class="mb-5">
                <h1 class="display-4 fw-bold mb-3">Trinquons à une autre page !</h1>
                <p class="lead opacity-75">
                    Il semble que la page que vous cherchez ait été bue jusqu'à la dernière goutte... ou elle n'a jamais existé.
                </p>
            </header>

            <div class="py-4 mb-5">
                <i class="bi bi-exclamation-octagon" style="font-size: 4rem;"></i>
            </div>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="/?p=accueil" class="btn-premium px-5 py-3 text-decoration-none">
                    RETOUR À L'ACCUEIL <i class="bi bi-house-door ms-2"></i>
                </a>
                <a href="/?p=produits" class="btn btn-outline-secondary px-5 py-3 rounded-0 border-2 text-uppercase fw-bold">
                    NOS PRODUITS
                </a>
            </div>

        </div>
    </div>
</main>