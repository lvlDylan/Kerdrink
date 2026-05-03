<?php
$currentPage = $_GET['page'] ?? 'accueil';
function isActive($pageName, $currentPage): string
{
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
            <?php if (!empty($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "adm"): ?>
                <a href="/?page=admin" class="<?= isActive('admin', $currentPage) ?>">Admin</a>
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]["idClient"])): ?>
                <a href="/?page=profile" class="<?= isActive('profile', $currentPage) ?>">Profile</a>
            <?php endif; ?>

            <a href="/?page=deconnexion">Déconnexion</a>
        <?php else: ?>
            <a href="/?page=connexion">Connexion</a>
        <?php endif; ?>
    </div>
</nav>