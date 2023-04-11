<?php
    require_once('templates/header.php');
    require_once('lib/recipe.php');
    include('test.php');

?>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <img src="<?=_RECIPES_IMG_PATH_.$recipe['image'] ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=$recipe['title'] ?></h1>
            <p class="lead"><?=$recipe['description'] ?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            </div>
        </div>
    </div>

<?php
require_once('templates/footer.php');
?>