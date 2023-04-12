<?php

$recipes = [
    ['title' => 'Mousse au chocolat', 'description' => 'un super dessert', 'image' => '1-chocolate-au-mousse.jpg'],
    ['title' => 'Gratin dauphinois', 'description' => 'du gratin', 'image' => '2-gratin-dauphinois.jpg'],
    ['title' => 'Salade', 'description' => 'plat pour l\'été', 'image' => '3-salade.jpg']
];

// Gestion de recette qui n'existerait pas
function getRecipeImage(string $image) {
    // Permet d'afficher une image par default s'il n'y en a pas dans la recette en BDD
    if ($image === null) {
        return _ASSETS_IMG_PATH_.'recipe_default.jpg';
    } else {
        return _RECIPES_IMG_PATH_.$image;
    }
}