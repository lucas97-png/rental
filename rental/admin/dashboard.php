<?php 

session_start();
require_once('../functions.php');
if(!isset($_SESSION['isLogged']) || $_SESSION['isLogged'] !== true) {
  die('Dostęp zabroniony');
}

?>



<!doctype html>
<html lang="pl">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/style.css">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

  <title>Dashboard</title>
</head>
<body>
    <div class="col12">
        <h1 class="text-center fw-bold p-5">Rezerwacje</h1>
        <div class="text-center">
            <a href="#" class="m-2">Powrót</a> | <a href="logout.php" class="m-2">Wyloguj</a>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <table class="table">
                <thead class="table-secondary">
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Samochód</th>
                    <th scope="col">Wypożyczył</th>
                    <th scope="col">Koszt</th>
                    <th scope="col">Zwrot</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <?php 
                  $rows = generateDashboard();

                  for($i = 0; $i < count($rows); $i++) {
                    echo '<tr>';
                    echo '<th scope="row">' . $i+1 . '</th>';
                    echo '<td>'.$rows[$i]['name'].'</td>';
                    echo '<td>'.$rows[$i]['surname'].'</td>';
                    echo '<td>'.$rows[$i]['cost'].'</td>';
                    echo '<td>'.$rows[$i]['to_date'].'</td>';

                  }
                  ?>
                    
                </tbody>
              </table>
        </div>
    </div>
</body>
</html>