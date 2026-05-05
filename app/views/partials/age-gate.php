<?php /** @var boolean $isMajor */ ?>
<?php if (!IS_MAJOR) : ?>
    <div id="age-gate-wrapper"
         class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
         style="z-index: 9999; background-color: rgba(255, 255, 255, 0.1); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px);">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-10 col-md-7 col-lg-5">

                    <div class="card border-0 shadow-sm p-4 p-md-5 text-center">
                        <header class="mb-5">
                            <span class="text-uppercase tracking-widest small opacity-50 d-block mb-2">Accès Réservé</span>
                            <h1 class="display-4 fw-black text-premium">KerDrink</h1>
                        </header>

                        <div class="mb-5">
                            <p class="text-uppercase fw-bold small tracking-widest mb-3">Vérification d'âge</p>
                            <p class="text-muted">
                                Vous devez avoir l'âge légal de consommer de l'alcool dans votre pays pour accéder à
                                Kozh Spirit.
                            </p>
                        </div>

                        <form method="POST" class="d-grid gap-3 col-lg-10 mx-auto">
                            <button type="submit" name="age_verify" class="btn-premium border-0 py-3 fw-bold">
                                J'AI PLUS DE 18 ANS
                            </button>

                            <a href="https://www.alcool-info-service.fr/"
                               class="btn btn-link text-decoration-none text-muted small text-uppercase tracking-widest">
                                Quitter le site
                            </a>
                        </form>

                        <div class="mt-5">
                            <p class="small opacity-50 mb-0" style="font-size: 0.65rem; letter-spacing: 0.2em;">
                                L'ABUS D'ALCOOL EST DANGEREUX POUR LA SANTÉ
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            overflow: hidden;
        }
    </style>
<?php endif; ?>