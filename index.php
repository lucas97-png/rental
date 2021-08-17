<?php require_once('functions.php')?>
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
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">

  <title>Wypożyczalnia</title>
</head>

<body>

  <!-- header -->
  <button onclick="smoothScroll('header')" id="up-button">^</button>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark p-2">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link p-3" href="#">Home</a>
            <a class="nav-link p-3" onclick="smoothScroll('#avaliable')">Dostępne auta</a>
            <a class="nav-link p-3" onclick="smoothScroll('#unavaliable')">Obecnie zarezerwowane</a>
            <a class="nav-link p-3" onclick="smoothScroll('#reservation')">Zarezerwuj</a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container h-75 d-flex align-items-center">
      <div class="row">
        <div class="col-12">
          <h1 class="text-white fw-bold">Wypożyczalnia Samochodów</h1>
        </div>
        <div class="col-12">
          <div class="row mt-5 d-flex">
            <button class="col-lg-3 col-md-6 col-sm-12 m-4 fw-bold" onclick="smoothScroll('#avaliable')">Oferta</button>
            <button class="col-lg-3 col-md-6 col-sm-12 m-4 fw-bold" onclick="smoothScroll('#reservation')">Rezerwuj</button>
          </div>
        </div>
      </div>
    </div>
  </header>


 
  <!-- header -->
  <!-- avalible -->
  <section id="avaliable">
    <div class="container-fluid p-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center p-5">Dostępne samochody</h1>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        
        <?php
          $rows = getCars('available');

          foreach($rows as $r) {
            echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
            echo '<div class="card">';
            echo '<img src="assets/'.$r['photo_url'].'" class="card-img-top" alt="car">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
            echo '<p class="text-center">'.$r['type'].'</p>';
            echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
            echo '<button class="btn btn-primary col-12" onclick="reserve('.$r['id'].');calculatePrice('.$r['price'].');">REZERWUJ</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        ?>
      </div>
    </div>
  </section>
  <!-- avalible -->
  <!-- unavaliable -->
  <section id="unavaliable">
    <div class="container-fluid p-5">
      <div class="row">
        <div class="col-12">
          <h1 class="text-center p-5">Obecnie zarezerwowane</h1>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        
      <?php
          $rows = getCars('unavailable');

          foreach($rows as $r) {
            echo '<div class="col-lg-3 col-md-6 col-sm-12 mt-3">';
            echo '<div class="card">';
            echo '<img src="assets/'.$r['photo_url'].'" class="card-img-top" alt="car">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title text-center">'.$r['name'].'</h5>';
            echo '<p class="text-center">'.$r['type'].'</p>';
            echo '<p class="text-center font-weight-bold">'.$r['price'].' zł / h</p>';
            echo '<button class="btn btn-danger col-12" disabled>Dostępny od '.substr($r['to_date'],0, -3).'</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        ?>


      </div>
    </div>
  </section>
  <!-- unavaliable -->
  <!-- reservation -->
  <section id="reservation">
    <div class="container-fluid">
      <h1 class="text-center p-5 fw-bold text-danger">Zarezerwuj</h1>
      <div class="row">
        <div class="col-12 text-center text-danger">
          <h4><span id="amount"> 0 </span>zł</h4>
        </div>
        <div class="col-12 d-flex justify-content-center p-5 text-white">
          <form action="reserve.php" method="POST">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="name">Imie</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Podaj imię" required>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="surname">Nazwisko</label>
                  <input type="text" class="form-control" name="surname" id="surname" placeholder="Podaj nazwisko"
                    required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="phone">Telefon</label>
              <input type="tel" class="form-control" name="phone" placeholder="Podaj numer telefonu" required>
            </div>
            <div class="form-group">
              <label for="car">Samochód</label>
              <select class="form-control" name="car" id="car">
              <?php
                  $rows = getCars("select");

                  foreach($rows as $r) {
                    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                  }
                ?>
              </select>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="date">Termin</label>
                  <input type="datetime-local" class="form-control" name="date" id="date" required>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="days">Dni</label>
                      <input type="number" class="form-control" name="days" id="days" min="0" max="13">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="hours">Godzin</label>
                      <input type="number" class="form-control" name="hours" id="hours" min="0" max="23">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group mt-5">
              <input type="submit" class="btn btn-danger" value="Rezerwuj">
            </div>
        </div>
      </div>
      
      </form>
    </div>
  </section>
  <footer class="page-footer font-small">
    <div class="col-12">
      <h6 class="text-center fw-bold p-2">&copy; LOLEK</h6>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
  </script>
  <script src="js/script.js"></script>
  
  


</body>

</html>