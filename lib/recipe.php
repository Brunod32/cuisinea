<?php

//$recipes = [
//    ['title' => 'Mousse au chocolat', 'description' => 'un super dessert', 'image' => '1-chocolate-au-mousse.jpg'],
//    ['title' => 'Gratin dauphinois', 'description' => 'du gratin', 'image' => '2-gratin-dauphinois.jpg'],
//    ['title' => 'Salade', 'description' => 'plat pour l\'été', 'image' => '3-salade.jpg']
//];

// Gestion de recette qui n'existerait pas
// grâce à |null , la fonction va accpeter un type string ou null, sans le programme plante
function getRecipeImage(string|null $image) {
    // Permet d'afficher une image par default s'il n'y en a pas dans la recette en BDD
    if ($image === null) {
        return _ASSETS_IMG_PATH_.'recipe_default.jpg';
    } else {
        return _RECIPES_IMG_PATH_.$image;
    }
}

// Permet de récupérer toutes les recettes en fonction id par order décroissant
// int $limit = null permet d'afficher toutes les recettes si aucune limite n'est fixé
function getRecipes(PDO $pdo, int $limit = null) {
    $sql = 'SELECT * FROM recipes ORDER BY id DESC';

    // si on ajoute une limite du nbr affichage recette
    if ($limit) {
        $sql .= ' LIMIT :limit';
    }
    $query = $pdo->prepare($sql);
    if ($limit) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

function getRecipeById(PDO $pdo, int $id) {
    //$pdo = new PDO('mysql:host=localhost:3307;dbname=cuisinea;charset=utf8mb4', 'root', 'Bandit@1200');
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    return $recipe = $query->fetch();
}