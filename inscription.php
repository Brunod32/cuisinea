<?php
    require_once('templates/header.php');
    require_once('lib/user.php');

    $errors = [];
    $messages = [];

    $users = [
        ['email'=>'abc@test.com', 'password'=>'1234'],
        ['email'=>'test@test.com', 'password'=>'test'],
    ];

    if(isset($_POST['addUser'])) {

        $res = addUser($pdo, $_POST['first_name'], $_POST['last_name'],$_POST['email'],$_POST['password']);

        if($res) {
            $messages[] = "Merci pour votre inscription";
        } else {
            $error[] = "Une erreur est survenue lors de votre inscription";
        }
    }


?>

    <h1>Inscription</h1>

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

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" name="first_name" id="first_name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" name="last_name" id="last_name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>


        <div class="mb-3">
            <input type="submit" value="Inscription" name="addUser" class="btn btn-primary">
        </div>

    </form>

<?php
require_once('templates/footer.php');
?>