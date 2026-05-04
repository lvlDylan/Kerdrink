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
        <a href="/?page=panier" class="cart-btn"><i class="bi bi-cart"></i></a>
    </div>

    <div class="nav-links mt-lg-2">
        <a href="/?page=accueil" class="<?= isActive('accueil', $currentPage) ?>">Accueil</a>
        <a href="/?page=produits" class="<?= isActive('produits', $currentPage) ?>">Produits</a>

        <?php if (isset($_SESSION["user"])): ?>
            <?php if (!empty($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] === "adm"): ?>
                <a href="/?page=admin" class="<?= isActive('admin', $currentPage) ?>">Admin</a>
                <?php if (strpos($_SERVER["SERVER_SOFTWARE"], "Apache") !== false): ?>
                    <a href="10.29.161.95:12322" target="_blank">Adminer</a>
                    <a href="10.29.161.95:12321" target="_blank">Webmin</a>
                <?php endif; ?>    
            <?php endif; ?>

            <?php if (isset($_SESSION["user"]["idClient"])): ?>
                <a href="/?page=profil" class="<?= isActive('profil', $currentPage) ?>">Profil</a>
            <?php endif; ?>

            <a href="/?page=deconnexion-exe">Déconnexion</a>
        <?php else: ?>
            <a href="/?page=connexion">Connexion</a>
        <?php endif; ?>
    </div>
</nav>