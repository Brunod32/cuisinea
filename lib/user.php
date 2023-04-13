<?php

function addUser($pdo, string $first_name, string $last_name, string $email, string $password) {

    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (:first_name, :last_name, :email, :password, :role);";
    $query = $pdo->prepare($sql);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $role = 'subscriber';
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);
    return $query->execute();
}