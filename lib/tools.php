<?php

// Prends une chaine de caractère et retourne un tableau
function linesToArray(String $string) {
    return explode(PHP_EOL, $string);
}