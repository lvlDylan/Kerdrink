<?php /** @var array $customer  */ ?>
<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px; background: #f8f9fa;">
                <div class="row g-0">
                    <div class="col-md-4 text-center p-5 d-flex flex-column align-items-center justify-content-center"
                         style="background-color: var(--acc); color: white;">
                        <div class="rounded-circle bg-white d-flex align-items-center justify-content-center mb-3 shadow"
                             style="width: 100px; height: 100px;">
                            <i class="bi bi-person-fill fs-1" style="color: var(--acc)"></i>
                        </div>
                        <h4 class="fw-bold mb-1">@<?= htmlspecialchars($customer["pseudo"]) ?></h4>
                        <span class="badge bg-light text-dark rounded-pill px-3">Client KerDrink</span>
                    </div>

                    <div class="col-md-8 p-5 bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="fw-bold mb-0">Mes Informations</h3>
                        </div>

                        <div class="row g-4">
                            <div class="col-sm-6">
                                <label class="text-uppercase small fw-bold text-muted mb-1 d-block">Nom</label>
                                <p class="fs-5 fw-semibold text-dark"><?= htmlspecialchars($customer["nom"]) ?></p>
                            </div>
                            <div class="col-sm-6">
                                <label class="text-uppercase small fw-bold text-muted mb-1 d-block">Prénom</label>
                                <p class="fs-5 fw-semibold text-dark"><?= htmlspecialchars($customer["prenom"]) ?></p>
                            </div>
                            <div class="col-12">
                                <hr class="opacity-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 border rounded-4 d-flex justify-content-between align-items-center bg-white shadow-sm position-relative">
                <div class="d-flex align-items-center gap-3">
                    <div class="p-3 rounded-3 bg-light">
                        <i class="bi bi-cart3 fs-4" style="color: var(--acc)"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Historique des commandes</h6>
                        <small class="text-muted">Consultez vos achats passés</small>
                    </div>
                </div>
                <a href="/historique" class="btn btn-light rounded-circle stretched-link"><i class="bi bi-chevron-right"></i></a>
            </div>

            <div class="mt-4 p-4 border rounded-4 bg-white shadow-sm">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="p-3 rounded-3 bg-light">
                        <i class="bi bi-shield-lock fs-4" style="color: var(--acc)"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-bold">Données personnelles & Confidentialité</h6>
                        <small class="text-muted">Gérez vos droits RGPD (accès, exportation et suppression)</small>
                    </div>
                </div>
                <div class="d-flex flex-wrap gap-2 pt-2 border-top">
                    <a href="/donnees/exporter" class="btn btn-outline-secondary btn-sm rounded-pill px-3 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-download"></i> Télécharger mes données
                    </a>
                    <form action="/donnees/supprimer" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir demander la suppression de vos données et de votre compte ? Cette action est irréversible.');">
                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-inline-flex align-items-center gap-2">
                            <i class="bi bi-trash"></i> Supprimer mon compte
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>