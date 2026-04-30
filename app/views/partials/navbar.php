<?php
$currentPage = $_GET['page'] ?? 'accueil';
function isActive($pageName, $currentPage) {
    return $pageName === $currentPage ? 'active-link' : '';
}
?>

<nav class="main-nav sticky-lg-top d-flex flex-column align-items-center gap-1 p-4">
    <a href="/" class="fs-1">Kozh Spirit</a>

    <div class="nav-utils">
        <button class="cart-btn">
            <i class="bi bi-cart"></i>
        </button>
    </div>

    <div class="nav-links mt-lg-2">
        <a href="/?page=accueil" class="<?= isActive('accueil', $currentPage) ?>">Accueil</a>
        <a href="/?page=produits" class="<?= isActive('produits', $currentPage) ?>">Produits</a>

        <?php if (isset($_SESSION["user"])): ?>
            <?php if ($_SESSION["user"]["role"] === "adm"): ?>
                <a href="/?page=admin" class="<?= isActive('admin', $currentPage) ?>">Admin</a>
            <?php endif; ?>

            <form action="../lib/actions/connexion.php?d=true" method="POST" class="d-inline">
                <input type="hidden" name="logout" value="true">
                <button type="submit" class="btn btn-link p-0 border-0 text-reset text-decoration-none shadow-none">Déconnexion</button>
            </form>
        <?php else: ?>
            <a href="/?page=connexion" class="<?= isActive('connexion', $currentPage) ?>">Connexion</a>
        <?php endif; ?>
    </div>
</nav>