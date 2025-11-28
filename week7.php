<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Black Love Books </title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <!-- Google Font for Bubble Letters -->
  <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">

  <style>
    /* Purple background for whole page */
    body {
      background-color: #9b59b6;
      color: white;
    }

    /* Bubble-letter style for title */
    h1.title {
      font-family: 'Luckiest Guy', cursive;
      font-size: 4rem;
      text-align: center;
      margin: 30px 0;
      text-shadow: 2px 2px #6a1b9a;
    }

    /* Table styling */
    table {
      background-color: white;
      color: black;
      border-radius: 8px;
      padding: 10px;
    }
  </style>
</head>

<body>

  <!-- Page Title -->
  <h1 class="title">Black Love Books</h1>
  <p class="text-center">Black Romance Recommendations!</p>

  <!-- Navigation Menu -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Menu</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="add_book.php">Page 1</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Page 2</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Page 3</a></li>
      </ul>
    </div>
  </nav>

  <!--  SEARCH BAR (Added Here)  -->
  <div class="container mb-4">
    <input 
      type="text" 
      id="searchInput" 
      class="form-control" 
      placeholder="Search books..."
      onkeyup="searchBooks()">
  </div>

  <!-- Table to display books -->
  <div class="container">
    <table class="table table-striped" id="bookTable">
      <thead class="table-dark">
        <tr>
          <th>Book Name</th>
          <th>Description</th>
          <th>Release Date</th>
        </tr>
      </thead>
      <tbody>
        <!-- Rows will be added here dynamically -->
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

  <!-- AJAX Script to fetch books -->
  <script>
    window.onload = function () {
      fetch('fetch_books.php')
        .then(response => response.json())
        .then(data => {
          const table = document.getElementById('bookTable').getElementsByTagName('tbody')[0];

          data.forEach(book => {
            const row = table.insertRow();
            row.insertCell(0).textContent = book.book_name;
            row.insertCell(1).textContent = book.book_description;
            row.insertCell(2).textContent = book.released_date;
          });
        })
        .catch(error => console.error('Error:', error));
    };

    /*  SEARCH FUNCTION (Added Here)  */
    function searchBooks() {
      const input = document.getElementById('searchInput').value.toLowerCase();
      const rows = document.querySelectorAll('#bookTable tbody tr');

      rows.forEach(row => {
        const bookName = row.cells[0].textContent.toLowerCase();
        const description = row.cells[1].textContent.toLowerCase();
        const releaseDate = row.cells[2].textContent.toLowerCase();

        if (
          bookName.includes(input) ||
          description.includes(input) ||
          releaseDate.includes(input)
        ) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }
  </script>

</body>
</html>