<?php
require_once('templates/header.php');
require_once('lib/recipe.php');
require_once('lib/tools.php');
require_once('lib/category.php');

// Si pas de user, on redirige vers page de login
if(!isset($_SESSION['user'])) {
    header("Location: login.php" );
}

$errors =[];
$messages =[];
//Pour ne pas vider les champs si pb lors de l'enregistrement, + ligne 47
$recipe = [
    'title' => '',
    'description' => '',
    'ingredients' => '',
    'instructions' => '',
    'category_id' => '',
];

$categories = getCategories($pdo);

if (isset($_POST['saveRecipe'])) {
    $fileName = null;
    // Teste si fichier est envoyé
    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] != '') {
        // la methode getimagessize va retourner false si  le fichier n'est pas une image
        $checkImage = getimagesize($_FILES['file']['tmp_name']);
        if($checkImage !== false) {
            // Si c'est une image, on traite
            // Renomme le fichier avec un uniqid pour éviter l'écrasement
            $fileName = uniqid().'-'.slugify($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], _RECIPES_IMG_PATH_.$fileName);
        } else {
            // Sinon, on affiche une erreur
            $errors[] = "Le fichier doit être une image";
        }
    }

    if (!$errors) {
        $res = saveRecipe($pdo, $_POST['category'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);

        if ($res) {
            $messages[] = "La recette a bien été sauvegardée";
        } else {
            $errors[] = "La recette n\'a  pas été sauvegardée";
        }
    }

    //Pour ne pas vider les champs si pb lors de l'enregistrement
    $recipe = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id' => $_POST['category'],
    ];
}

?>
<h1 class="text-center">Ajouter une recette</h1>

<?php foreach($messages as $message) {?>
    <div class="alert alert-success">
        <?= $message; ?>
    </div>
<?php } ?>


<?php foreach($errors as $error) {?>
    <div class="alert alert-danger">
        <?= $error; ?>
    </div>
<?php } ?>

<!-- enctype="multipart/form-data" permet de récupérer le formulaire côté php-->
<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Nom de la recette</label>
        <input type="text" name="title" id="title" class="form-control" value="<?= $recipe['title']; ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" cols="30" rows="5" class="form-control"><?= $recipe['description']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="ingredients" class="form-label">Ingrédients</label>
        <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control"><?= $recipe['ingredients']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea name="instructions" id="instructions" cols="30" rows="5" class="form-control" ><?= $recipe['instructions']; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label">Catégorie</label>
        <select name="category" id="category" class="form-select">
            <?php foreach($categories as $category) { ?>
                <option value="<?= $category['id'] ?>" <?php if($recipe['category_id'] == $category['id']) echo 'selected="selected"'; ?> ><?= $category['name'] ?></option>
            <?php }?>

        </select>
    </div>

    <div class="mb-3">
        <label for="file" class="form-label">Image</label>
        <input type="file" name="file" id="file">
    </div>
    <div class="mb-3">
        <input type="submit" value="Enregistrer" name="saveRecipe" class="btn btn-primary">
    </div>

</form>

<?php
require_once('templates/footer.php');
?>