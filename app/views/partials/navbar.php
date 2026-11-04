<?php
$currentPage = $_SESSION['current_page'] ?? 'accueil';
function isActive($pageName, $currentPage): string
{
    return $pageName === $currentPage ? 'active-link' : '';
}
?>

<nav class="main-nav sticky-lg-top d-flex flex-column align-items-center gap-1 p-4">
    <a href="/" class="fs-1">Kozh Spirit</a>

    <div class="nav-utils">
        <a href="/panier" class="cart-btn"><i class="bi bi-cart"></i></a>
    </div>

    <div class="nav-links mt-lg-2">
        <a href="/accueil" class="<?= isActive('accueil', $currentPage) ?>">Accueil</a>
        <a href="/produits" class="<?= ($currentPage === 'produits' || $currentPage === 'produits-detail') ? 'active-link' : '' ?>">Produits</a>

        <?php if (isset($_SESSION["user"])): ?>
            <?php if (!empty($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "adm"): ?>
                <a href="/admin" class="<?= isActive('admin', $currentPage) ?>">Admin</a>
                <?php if (str_contains($_SERVER["SERVER_SOFTWARE"], "Apache")): ?>
                    <a href="https://10.29.161.95:12322" target="_blank">Adminer</a>
                    <a href="http://10.29.161.95:12321" target="_blank">Webmin</a>
                <?php endif; ?>    
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]["idClient"])): ?>
                <a href="/profil" class="<?= isActive('profil', $currentPage) ?>">Profil</a>
            <?php endif; ?>

            <a href="/deconnexion-exe">Déconnexion</a>
        <?php else: ?>
            <a href="/connexion" class="<?= isActive('connexion', $currentPage) ?>">Connexion</a>
        <?php endif; ?>
    </div>
</nav>