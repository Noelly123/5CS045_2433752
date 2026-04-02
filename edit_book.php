<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt = $pdo->prepare("SELECT * FROM books WHERE id = :id");
$stmt->execute(["id" => $id]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = filter_input(INPUT_POST, "book_name", FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, "book_description", FILTER_SANITIZE_SPECIAL_CHARS);
    $date = filter_input(INPUT_POST, "released_date", FILTER_SANITIZE_SPECIAL_CHARS);

    $sql = "UPDATE books
            SET book_name = :name,
                book_description = :description,
                released_date = :date
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "name" => $name,
        "description" => $description,
        "date" => $date,
        "id" => $id
    ]);

    header("Location: books.php");
    exit;
}
?>

<form method="post">
    <input type="text" name="book_name"
           value="<?= htmlspecialchars($book["book_name"]) ?>" required>

    <textarea name="book_description" required><?= htmlspecialchars($book["book_description"]) ?></textarea>

    <input type="date" name="released_date"
           value="<?= htmlspecialchars($book["released_date"]) ?>" required>

    <button type="submit">Update Book</button>
</form>