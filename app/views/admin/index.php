<main class="d-flex flex-column align-items-center justify-content-center mt-2">

    <?php if ($flash = Helper::getFlash()): ?>
        <div class="container-fluid mb-4" style="max-width: 800px;">
            <div class="alert alert-dismissible alert-<?= $flash["type"] === 'error' ? 'danger' : 'success' ?> border-0 shadow-sm d-flex align-items-center" role="alert" id="flash-toast">
                <i class="bi <?= $flash["type"] === 'error' ? 'bi-exclamation-octagon-fill' : 'bi-check-circle-fill' ?> fs-4 me-3"></i>
                <div>
                    <strong><?= $flash["type"] === 'error' ? 'Erreur :' : 'Succès :' ?></strong> <?= $flash["message"] ?>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <section class="mb-5">
        <h2 class="h4 border-bottom pb-3 mb-4 text-uppercase ls-lg">Employé(e)</h2>
        <div class="table-responsive">
            <table class="table table-borderless bg-transparent align-middle">
                <thead>
                <tr class="small text-uppercase border-bottom border-secondary">
                    <th class="py-3 fw-normal">Login</th>
                    <th class="py-3 fw-normal">Nom</th>
                    <th class="py-3 fw-normal">Prénom</th>
                    <th class="py-3 fw-normal">Rôle</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $users */ foreach ($users as $user):?>
                    <tr class="border-bottom border-secondary">
                        <td class="py-4 fw-bold"> <?= $user["login"] ?></td>
                        <td class="py-4 text-uppercase"><?= $user["nom"] ?></td>
                        <td class="py-4"><?= $user["prenom"] ?></td>
                        <td class="py-4"><?= $user["role"] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="mb-5">
        <h2 class="h4 border-bottom pb-3 mb-4 text-uppercase ls-lg">Clients</h2>
        <div class="table-responsive">
            <table class="table table-borderless bg-transparent align-middle">
                <thead>
                <tr class="small text-uppercase border-bottom border-secondary">
                    <th class="py-3 fw-normal">Identité</th>
                    <th class="py-3 fw-normal">Alias</th>
                    <th class="py-3 fw-normal">Courriel</th>
                    <th class="py-3 fw-normal text-end">Téléphone</th>
                </tr>
                </thead>
                <tbody>

                <?php /** @var array $clients */foreach ($clients as $client):?>
                    <tr class="border-bottom border-secondary">
                        <td class="py-4">
                            <span class="d-block text-uppercase fw-bold"><?= $client["nom"] ?></span>
                            <small class="opacity-50"><?= $client["prenom"] ?></small>
                        </td>
                        <td class="py-4">
                        <span class="border border-secondary px-3 py-1 rounded-pill small">
                            <?= $client["pseudo"] ?>
                        </span>
                        </td>
                        <td class="py-4"><?= $client["mail"] ?: "Aucun courriel renseigné" ?></td>
                        <td class="py-4 text-end"><?= $client["telephone"] ?: "Aucun téléphone renseigné" ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="mb-5">
        <h2 class="h4 border-bottom pb-3 mb-4 text-uppercase ls-lg">Commandes à traiter</h2>
        <div class="table-responsive">
            <table class="table table-borderless bg-transparent align-middle">
                <thead>
                <tr class="small text-uppercase border-bottom border-secondary">
                    <th class="py-3 fw-normal">N° Commande</th>
                    <th class="py-3 fw-normal">Client</th>
                    <th class="py-3 fw-normal">Date</th>
                    <th class="py-3 fw-normal">Statut actuel</th>
                    <th class="py-3 fw-normal text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var array $orders */ foreach ($orders as $order): ?>
                    <tr class="border-bottom border-secondary">
                        <td class="py-4 fw-bold">#<?= $order["noCommande"] ?></td>
                        <td class="py-4 text-uppercase"><?= $order["nom"] ?> <?= $order["prenom"] ?></td>
                        <td class="py-4"><?= date('d/m/Y', strtotime($order["dateCommande"])) ?></td>
                        <td class="py-4">
                            <span class="badge bg-warning text-dark rounded-pill px-3">
                                <?= $order["libelleStatut"] ?>
                            </span>
                        </td>
                        <td class="py-4 text-end">
                            <form action="/admin-update-statut-exe" method="POST" class="d-inline">
                                <input type="hidden" name="noCommande" value="<?= $order["noCommande"] ?>">
                                <a href="/admin/orders/detail/<?=$order["noCommande"]?>" class="text-muted link-underline-opacity-0 border-0 px-3 py-2 small"> DÉTAIL <i class="bi bi-eye"></i></a>
                                <button type="submit" class="btn-premium border-0 px-3 py-2 small">
                                    EXPÉDIER <i class="bi bi-truck ms-1"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 opacity-50 italic">
                            Aucune commande en attente de traitement.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>