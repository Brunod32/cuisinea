<?php
    require_once('lib/config.php');
//    pour donner la class active à la page consultée
    $currentPage =  basename($_SERVER['SCRIPT_NAME']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Cuisinea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="assets/images/logo-cuisinea-horizontal.jpg" alt="Logo cuisinea" width="250">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <?php foreach ($mainMenu as $key => $value) { ?>
            <li class="nav-item"><a href="<?= $key;?>" class="nav-link px-2 <?php if ($currentPage === $key) { echo 'active'; } ?>"><?= $value ;?></a>
            <?php } ?>
        </ul>

        <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary me-2">Login</button>
            <button type="button" class="btn btn-primary">Sign-up</button>
        </div>
    </header>
