<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');

$id = (int)$_GET['id'];
$recipe = getRecipeById($pdo, $id);

//Suppression de recette
 if(isset($_SESSION['user'])) {
     $errors = [];
     $messages = [];
     if (isset($_POST['recipeToDelete'])) {
        if (!$errors) {
            $res = deleteRecipe($pdo, $_GET['id']);
            if ($res) {
                $messages[] = "La recette a bien été supprimée";
                header("location: recettes.php");
            } else {
                $errors[] = "La recette n\'a  pas été supprimée";
            }
        }
    }
 }

if($recipe) {
    // Permet de recupérer les ingrédients et les afficher en appelant la fonction de tools.php
    $ingredients = linesToArray($recipe['ingredients']);
    $instructions = linesToArray($recipe['instructions']);

?>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
            <!-- appel de la fonction getRecipeImage de recipe.php-->
            <img src="<?=getRecipeImage($recipe['image']); ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
        </div>
        <div class="col-lg-6">
            <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3"><?=$recipe['title']; ?></h1>
            <p class="lead"><?=$recipe['description']; ?></p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            </div>
        </div>
    </div>

    <div class="row flex-lg-row align-items-center g-5 py-5">
        <h2>Ingrédients</h2>
        <ul class="list-group col-4">
            <?php foreach($ingredients as $key => $ingredient) {?>
                <li class="list-group-item"><?=$ingredient; ?></li>
            <?php } ?>
        </ul>
    </div>

    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <h2>Instruction</h2>
        <ol>
            <?php foreach($instructions as $key => $instruction) {?>
                <li><?=$instruction; ?></li>
            <?php } ?>
        </ol>
    </div>

    <?php
    if(isset($_SESSION['user'])) { ?>
        <div class="d-flex justify-content-end">
            <form method="post" enctype="multipart/form-data">
<!--                ne pas oublier d'ajouter un input hidden avec en value l'id de la recette -->
                <input type="hidden" name="recipeToDelete" value="<?=$recipe['id']; ?>">
                <input type="submit" class="btn btn-danger" value="Supprimer la recette">
            </form>
        </div>
    <?php } ?>

<?php } else { ?>
    <div class="row text-center">
        <h1>Oups... recette introuvable</h1>
    </div>
<?php } ?>

<?php
require_once('templates/footer.php');
?>