<?php
// Read values from the form
$book_name = $_POST['book_name'];
$book_description = $_POST['book_description'];
$released_date = $_POST['date_released'];

// Connect to database
include("db.php");

// Build SQL statement
$sql = "INSERT INTO books (book_name, book_description, released_date)
        VALUES ('{$book_name}', '{$book_description}', '{$released_date}')";

// Run SQL statement and report errors
if (!$mysqli->query($sql)) {
    echo("<h4>SQL error description: " . $mysqli->error . "</h4>");
}

// Redirect to book list page
header("Location: list-games.php");
exit;
?>
