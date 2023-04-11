<?php

$pdo = new PDO('mysql:dbname=cuisinea;host=localhost;charset=utf-8mb4', 'root', '');
$id = $_GET['id'];
$query = $pdo -> prepare("SELECT * FOM users WHERE id");
$query->execute();
$result = $query->fetch();