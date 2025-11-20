<!DOCTYPE html>
<html>
<head>
  <title>Black Love</title>
  <!-- Add AJAX script to fetch book data -->
  <script>
    // This function runs when the page is loaded
    window.onload = function() {
      // Fetch the books using AJAX from fetch_books.php
      fetch('fetch_books.php')
        .then(response => response.json())  // Parse the JSON response
        .then(data => {
          let table = document.getElementById('bookTable');  // Get the table element by ID
          
          // Loop through each book and add it as a new row in the table
          data.forEach(book => {
            let row = table.insertRow();  // Create a new row for each book
            row.insertCell(0).textContent = book.book_name;        // Book name
            row.insertCell(1).textContent = book.book_description; // Book description
            row.insertCell(2).textContent = book.released_date;    // Release date
          });
        })
        .catch(error => console.error('Error:', error));  // Handle any errors
    };
  </script>
</head>
<body>

  <h1>Black Love</h1>
  <p>Black Romance to be recommended!</p>

  <!-- Table to display the book data dynamically -->
  <table id="bookTable" border="1">
    <thead>
      <tr>
        <th>Book Name</th>
        <th>Description</th>
        <th>Release Date</th>
      </tr>
    </thead>
    <tbody>
      <!-- Book rows will be dynamically added here by AJAX -->
    </tbody>
  </table>

</body>
</html>