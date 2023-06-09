<?php
    require_once('templates/header.php');
    require_once('lib/user.php');

    $errors = [];
    $messages = [];

    if(isset($_POST['loginUser'])) {
        $user = verifyLoginPassword($pdo, $_POST['email'], $_POST['password']);
        if ($user) {
            $_SESSION['user'] = ['email' => $user['email']];
            header("Location: index.php" );
        } else {
            $errors[] = "Email ou mot de passe incorrect";
        }

    }


?>

    <h1>Connexion</h1>

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
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>


        <div class="mb-3">
            <input type="submit" value="Se connecter" name="loginUser" class="btn btn-primary">
        </div>

    </form>



<?php
    require_once('templates/footer.php');
?>