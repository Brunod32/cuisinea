<?php
    const _RECIPES_IMG_PATH_ = '/recipes/';

    $recipes = [
        ['title' => 'Mousse au chocolat', 'description' => 'un super dessert', 'image' => '1-chocolate-au-mousse.jpg'],
        ['title' => 'Gratin dauphinois', 'description' => 'du gratin', 'image' => '2-gratin-dauphinois.jpg'],
        ['title' => 'Salade', 'description' => 'plat pour l\'été', 'image' => '3-salade.jpg']
    ];

require_once('templates/header.php');
?>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="assets/images/logo-cuisinea.jpg" class="d-block mx-lg-auto img-fluid" alt="Logo Cuisinea" width="350px" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Cuisinea - Recettes de cuisine</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Voir nos recettes</button>
            </div>
        </div>
    </div>

    <div class="row">

        <?php
        foreach($recipes as $recipe) { ?>

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?=_RECIPES_IMG_PATH_.$recipe['image'] ?>" class="card-img-top" alt="<?= $recipe['title'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $recipe['title'] ?></h5>
                        <p class="card-text"><?= $recipe['description'] ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

<?php
    require_once('templates/footer.php');
?>