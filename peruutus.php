<!DOCTYPE html>
<html lang="fi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Imaginary Gastropub on kaupungin paras gastropub! Kokoamme laadukkaimmat 
    paikalliset raaka-aineet ja taiomme niistä suussasulavia makuelämyksiä, jotka on helppo huuhdella alas 
    paikallisten panimoiden oluilla.">
  <title>Imaginary Gastropub</title>
  <link rel="icon" type="image/x-icon" href="images/igp-dark.svg">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Own CSS-->
  <link rel="stylesheet" href="styles.css">
  <!--Google fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300..800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@1,300..500&display=swap" rel="stylesheet">
</head>

<body>
  <div class="container">

    <!--NAVBAR-->
    <nav id="navbar-container" class="navbar-container">
      <div class="navbar-top">
        
        <div id="navbar-top-left">
          <a id="navbar-logo-button" href="index.html"><img id="navbar-logo" src="images/igp.svg" alt="Logo" title="Etusivu"></a>
        </div>

        <div id="navbar-top-right">
          <ul>
            <li>
              <!-- Linkki toimii JS-scriptin avulla ks. koodi.js -->
              <a id="hamburger-button" href="#">
                <img id="hamburger-icon" src="images/Hamburger_icon.svg" alt="Valikko">
              </a>
            </li>
            <li>
              <a id="reservation-link" class="navbar-link" href="yhteydenotto.html#reservation">Pöytävaraus</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- piiloon menevä divi, jossa linkit -->
      <div id="collapsible-div" class="navbar-bottom">
        <ul>
          <li><a class="navbar-link" href="index.html">Etusivu</a></li>
          <li><a class="navbar-link" href="menu.html">Menu</a></li>
          <li><a class="navbar-link" href="juomat.html">Juomat</a></li>
          <li><a class="navbar-link" href="tarina.html">Meistä</a></li>
          <li><a class="navbar-link" href="yhteydenotto.html">Yhteys</a></li>
          <li><a id="hidden-link" class="navbar-link" href="yhteydenotto.html#reservation">Varaus</a></li>
          <li><a class="navbar-link disabled-link" href="#">In English</a></li>
        </ul>
      </div>
    </nav>

    <!--HEADER-->
    <header>
      <div class="row">
        <div class="col-md-12">
          <div class="banner">
            <img class="header-image img-fluid" src="images/gastropubheader.jpg" alt="Banneri">
            <img id="logo" class="img-fluid" src="images/gastropublogo.svg" alt="Yrityksen logo">
          </div>
        </div>
      </div>
    </header>

    <!--MAIN-->
    <main>
        <div class="content">
          <div class="row">
            <div class="col-md-12">

              <?php

              // yhteys
              include('configs/dbConfigs.php'); 

              // tarkistaa löytyykö syötetty varaus
              $checkReservations = "SELECT * FROM gastropub_reservations WHERE reservationid = ? and surname = ?";

              // Saa urlissa id:n ja sukunimen
              $reservationId = $_GET['reservation-id'];
              $surname =  $_GET['surname'];

              $stmt = $pdo->prepare($checkReservations); 

              $stmt->execute([$reservationId, $surname]);

              $rows = $stmt -> fetchAll();

              if (count($rows) == 0){
                  echo '<div class="feedback-card-centered">';
                  echo '<h1 class="admin-h1">Annetuilla tiedoilla ei varauksia</h1>
                        <p><a class="content-button" href="javascript:history.back()">Takaisin</a></p>';
                  echo '</div>';
              }

              else {
              // Poistaa varauksen
              $sql = "DELETE FROM gastropub_reservations WHERE reservationid = ? and surname = ? ";

              $stmt = $pdo->prepare($sql); 

              $stmt->execute([$reservationId, $surname]);
              
              // Suljetaan yhteys
              $pdo->connection = null;

              echo '<div class="feedback-card-centered">';
              echo '<h1 class="admin-h1">Varauksesi poistettu onnistuneesti</h1>
                    <p><a class="content-button" href="javascript:history.back()">Takaisin</a></p>';
              echo '</div>'; 
              }
              ?>
                  
            </div>
          </div>    
        </div>
    </main>

    <!--FOOTER-->
    <footer>
      <div class="footer-margins">
        <div class="row">
          <div class="col-4 contact-info">
            <h3>Yhteystiedot</h3>
            <address>Imaginary Gastropub<br>
              Lorem ipsumin tie 123<br>
              12345 Lipsumila<br>
              (01) 123 4567<br>
              email@imaginarygastropub.fi
            </address>
          </div>
          <div class="col-4 opening-hours">
            <h3>Aukioloajat</h3>
            <table id="opening-hours-table">
              <tr>
                <td>ma-to &nbsp;</td>
                <td>16-23</td>
              </tr>
              <tr>
                <td>pe-la</td>
                <td>16-02</td>
              </tr>
              <tr>
                <td>su</td>
                <td>14-23</td>
              </tr>
            </table>
          </div>
          <div class="col-md-4 some">
            <h3>Sosiaalinen media</h3>
            <p>
              <a href="#"><img class="some-icon" src="images/icons8-facebook.svg" alt="Facebook"></a>
              <a href="#"><img class="some-icon" src="images/icons8-instagram.svg" alt="Instagram"></a>
              <a href="#"><img class="some-icon" src="images/icons8-twitter.svg" alt="Twitter"></a>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

    <script src="koodi.js"></script>
  </div>
</body>

</html>
          