<?php
// Point to library (Twig)
require_once '../../vendor/autoload.php';

// Set up Twig environment
$loader = new \Twig\Loader\FilesystemLoader('.');
$twig   = new \Twig\Environment($loader);

// Include database connection
include("db.php");

// Run SQL query
$sql = "SELECT * FROM videogames ORDER BY released_date";
$results = mysqli_query($mysqli, $sql);

// Count rows returned
$num_rows = mysqli_num_rows($results);

// Load and render template
echo $twig->render('games.html', [
    'num_rows' => $num_rows,
    'results'  => $results
]);
?>