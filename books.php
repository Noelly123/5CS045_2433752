<?php
session_start();

/*
  SECURITY: protect page
  (teacher can see session use)
*/
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/*
  Database connection
*/
require_once "db.php";

/*
  READ: fetch books safely
*/
$sql = "SELECT id, book_name, book_description, released_date FROM books ORDER BY released_date DESC";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Black Love Books</title>

    <!-- Bootstrap CDN -->
    https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css

    <style>
        body {
            background-color: #9b59b6;
        }
        h1 {
            color: white;
            text-align: center;
            margin: 30px 0;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">

    <h1>Black Love Books</h1>

    <!-- ADD BOOK -->
    <div class="text-center mb-4">
        add_book.phpAdd New Book</a>
    </div>

    <div class="row">

        <?php if ($result->num_rows === 0): ?>
            <p class="text-center text-white">No books found.</p>
        <?php endif; ?>

        <?php while ($book = $result->fetch_assoc()): ?>

            <div class="col-md-4">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars($book['book_name']) ?>
                        </h5>

                        <p class="card-text">
                            <?= htmlspecialchars($book['book_description']) ?>
                        </p>

                        <p class="text-muted">
                            Released: <?= htmlspecialchars($book['released_date']) ?>
                        </p>

                        <!-- EDIT & DELETE -->
                        edit_book.php?id=<?= $book['id'] ?>
Edit</a>

                        delete_book.php?id=<?= $book['id'] ?>
Delete</a>
                    </div>

                </div>
            </div>

        <?php endwhile; ?>

    </div>
</div>

</body>
</html>