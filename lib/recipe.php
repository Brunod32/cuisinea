<?php

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

// Permet de récupérer les recettes en fonction id par ordre décroissant
// int $limit = null permet d'afficher toutes les recettes si aucune limite n'est fixé
// ORDER BY RAND() : fonction random sql pour ne pas afficher toujours les mêmes recette selon le nbr limite
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

function saveRecipe(PDO $pdo, int $category, string $title, string $description, string $ingredients, string $instructions, string|null $image): bool
{
    $sql = "INSERT INTO `recipes` (`id`, `category_id`, `title`, `description`, `ingredients`, `instructions`, `image`) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image);";
    $query = $pdo->prepare($sql);
    $query->bindParam(':category_id', $category, PDO::PARAM_INT);
    $query->bindParam(':title', $title, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    $query->bindParam(':image', $image, PDO::PARAM_STR);
    return $query->execute();
}

function deleteRecipe(PDO $pdo, int $id)
{
    $sql = "DELETE FROM `recipes` WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    return $query->execute();
}