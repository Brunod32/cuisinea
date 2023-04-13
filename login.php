<?php
    require_once('templates/header.php');

    $errors = [];
    $messages = [];

    $users = [
        ['email'=>'abc@test.com', 'password'=>'1234'],
        ['email'=>'test@test.com', 'password'=>'test'],
    ];

    if(isset($_POST['loginUser'])) {
        $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $query->execute();
        $user =  $recipe = $query->fetch();

        if ($user && $user['password'] === $_POST['password']) {
            $messages[] = 'Connexion OK';
        } else {
            $errors[] = "Email ou mdp incorrect";
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
            <input type="submit" value="Enregistrer" name="loginUser" class="btn btn-primary">
        </div>

    </form>



<?php
    require_once('templates/footer.php');
?>