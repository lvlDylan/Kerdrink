<head>
    <meta charset="UTF-8">
    <meta name="author" content="Lavieille Dylan">
    <meta name="description" content="Essayer les voyages intergalactiques avec nos nouvelles destinations !">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="fr">

    <title>Kerdrink</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/svg+xml" href="/img/favicon.svg">

    <?php
    $is_local = in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']);
    if ($is_local):
    ?>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <?php else: ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous"/>
    <?php endif; ?>

    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" type="image/svg+xml" href="/resources/favicon.svg">
</head>