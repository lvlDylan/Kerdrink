<?php
require_once ROOT . "app/views/partials/head.php";
require_once ROOT . "app/views/partials/navbar.php";
?>

<main class="container d-flex align-items-center justify-content-center min-vh-75 py-5">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

        <header class="text-center mb-5">
            <h1 class="h2 fw-bold text-premium mb-2">Accès à votre compte</h1>
            <p class="small opacity-50 text-uppercase tracking-widest">Identifiez-vous pour profiter pleinement de notre boutique</p>
        </header>

        <section class="card planet-card p-4 p-md-5 shadow-lg border-0">

            <?php if (isset($_GET['error'])): ?>
                <div class="d-flex align-items-center p-3 mb-4 rounded-3 border-start border-4 shadow-sm"
                     style="background: var(--acc-soft); border-color: var(--acc) !important;">
                    <i class="bi bi-exclamation-triangle-fill me-3" style="color: var(--acc);"></i>
                    <div style="color: var(--txt); font-size: 0.85rem; font-weight: 500;">
                        <?php
                        if($_GET['error'] == 'login') echo "Identifiants invalides. Vérifiez vos identifiants.";
                        else if ($_GET['error'] == 'notLoggedIn') echo "Vous devez être connecté pour accéder à ce contenu.";
                        else echo "Une erreur est survenue lors de votre connexion.";
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <form action="/?p=connexion-exe" method="POST">
                <div class="mb-4">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">IDENTIFIANT</label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-person text-info" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="text" name="login" class="form-control bg-transparent border-0 text-white"
                                   placeholder="Identifiants..." required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="form-label small opacity-50 fw-bold" style="color: var(--txt); letter-spacing: 1px;">MOT DE PASSE</label>
                    <div class="input-group rounded-3 border" style="background: rgba(0,0,0,0.2); border-color: var(--border) !important;">
                        <span class="input-group-text bg-transparent border-0"><i class="bi bi-shield-lock text-info" style="color: var(--acc) !important;"></i></span>
                        <label>
                            <input type="password" name="password" class="form-control bg-transparent border-0 text-white"
                                   placeholder="••••••••" required style="color: var(--txt) !important;">
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-premium w-100 py-3 text-uppercase shadow-sm">
                    Se connecter <i class="bi bi-key ms-2"></i>
                </button>
            </form>

            <footer class="mt-4 text-center">
                <a href="/?page=inscription" class="small text-decoration-none opacity-50 hover-opacity-100" style="color: var(--txt);">
                    Pas encore de compte client ? <span style="color: var(--acc);">S'inscrire</span>
                </a>
            </footer>
        </section>

    </div>
</main>