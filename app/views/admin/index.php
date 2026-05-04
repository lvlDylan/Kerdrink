<main class="d-flex flex-column align-items-center justify-content-center mt-2">
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
</main>