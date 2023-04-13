<?php
require_once('templates/header.php');
require_once('lib/recipe.php');

// Recupère toutes les recette en fonction id par order décroissant
$recipes = getRecipes($pdo);
?>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <h1>Liste des recettes</h1>
    </div>

    <div class="row">

        <?php
        foreach($recipes as $key =>$recipe) {
            include('templates/recipe_partial.php');
        } ?>
    </div>

<?php
require_once('templates/footer.php');
?>