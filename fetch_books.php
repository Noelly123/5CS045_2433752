<?php
// Connect to the MySQL database
$mysqli = new mysqli("localhost", "2433752", "574sa7", "db2433752");

if ($mysqli->connect_errno) {
    echo json_encode(["error" => "Failed to connect to MySQL: " . $mysqli->connect_error]);
    exit();
}

// Run SQL query to fetch all books ordered by release date
$sql = "SELECT * FROM books ORDER BY released_date";
$results = mysqli_query($mysqli, $sql);

// Initialize an empty array to store books
$books = [];

// Fetch each row of book data and add to the books array
while ($a_row = mysqli_fetch_assoc($results)) {
    $books[] = $a_row;
}

// Return the books array as JSON
echo json_encode($books);
?>