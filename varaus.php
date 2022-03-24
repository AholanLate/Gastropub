<!DOCTYPE html>
<html lang="fi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imaginary Gastropub - Pöytävaraus</title>
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
<main>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        
        <?php 

          // yhteys
          include('configs/dbConfigs.php'); 
        
          // sql-lauseen valmistelu
          $sql = "INSERT INTO gastropub_reservations (firstname, surname, email, phonenumber, date, time, participants, reservationid) VALUES (?,?,?,?,?,?,?,?)";

          $stmt = $pdo->prepare($sql);

          $firstname = $_POST['firstname'];
          $surname = $_POST['surname'];
          $email = $_POST['email'];
          $phonenumber = $_POST['phonenumber'];
          $date = $_POST['date'];
          $time = $_POST['time'];
          $participants = $_POST['participants'];
          // arpoo varausid:n
          $reservationid = random_int(1000000, 9999999);

          // Sanitointi

          $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
          $surname = filter_var($surname, FILTER_SANITIZE_STRING);
          $email = filter_var($email, FILTER_SANITIZE_EMAIL);
          $phonenumber = filter_var($phonenumber, FILTER_SANITIZE_NUMBER_INT);
          $participants = filter_var($participants, FILTER_SANITIZE_NUMBER_INT);
          $date = preg_replace("([^0-9-])", "", $date);
          $time = preg_replace("([^0-9:])", "", $time);
          $reservationid = filter_var($reservationid, FILTER_SANITIZE_NUMBER_INT);

          //validointi
          $errors = "";

          // sähköpostiosoitteen tarkistus
          if(!filter_var($email, FILTER_VALIDATE_EMAIL))
          {
            $errors .= "<p>Tarkista, että sähköpostiosoitteesi on oikeassa muodossa.</p>";
          }

          // tarkistaa onko tilaa haluttuna aikana (+/-2h)
          $time = date($time); 
          $twoHoursBefore = date("H:i:s", strtotime('-2 hours', strtotime($time)));
          $twoHoursAfter = date("H:i:s", strtotime('+2 hours', strtotime($time)));

          $checkReservations = "SELECT * FROM gastropub_reservations 
          WHERE date ='$date' AND time BETWEEN '$twoHoursBefore' AND '$twoHoursAfter' ";

          $check = $pdo->prepare($checkReservations);
          $check->execute();
          $rows = $check -> fetchAll();

          $pax = $participants;
          foreach ($rows as $row)
          {
            $pax = $pax + $row['participants'];
          }
          if ($pax > 40) 
          {
            $errors .= "<p>Emme valitettavasti ota valitsemallasi ajankohdalle enempää varauksia.</p>";
          }

          // varaukset aikaisintaan 2h päähän
          $today = date("Y-m-d");
          $timeNow = date("H:i:s");
          $puskuri = date("H:i:s", strtotime('+3 hours', strtotime($timeNow)));

          if ($date == $today && $time < $puskuri)
          {
            $errors .= "<p>Voit tehdä pöytävarauksen aikaisintaan kolmen tunnin päähän.</p>";
          } 

          // tarkistaa, että päivämäärä ei ole mennyt
          if ($date < $today)
          {
              $errors .= "<p>Valitse nykyinen tai tuleva päivämäärä</p>";
          }

          // Tarkistaa, että varausaika 16-22. (tosin korjattu myös lomake ottamaan vain sallitut ajankohdat)
          $opening = "15:59:59";
          $closing = "21:00:01";

          if ( $time < $opening || $time > $closing)
          {
              $errors .= "<p>Voit tehdä pöytävarauksen 16:00 - 21:00 väliselle ajalle.</p>";
          }

          // Jos ei virheitä, lähettää varauksen
          if ($errors=="")
          {
          $stmt->execute([$firstname, $surname, $email, $phonenumber, $date, $time, $participants, $reservationid]);

          // sulje yhteys
          $pdo->connection = null;

          echo  '<div class="feedback-card-centered">';
          echo  "<h1 class='admin-h1'>Pöytävarauksesi tallennettu!</h1>";

          $timeformat = date_create($time);
          $dateformat = date_create($date);

          echo  "<p>Päivämäärä: " . date_format($dateformat, 'd.m.Y') . "</p>
                <p>Kello: " . date_format($timeformat, 'H.i') . "</p>
                <p>Henkilömäärä: $participants </p>
                <p>Varausnumerosi: <b>$reservationid</p>
                <p>Kirjoita varausnumero itsellesi talteen!</p>
                <p><a class='content-button' href='javascript:history.back()'>Takaisin</a></p>";
          echo  "</div>";
          }

          else
          {
          echo  '<div class="feedback-card-centered">';
          echo  "<h1 class='admin-h1'>Tietoja ei tallennettu</h1>";
          echo  $errors;
          echo  "<p><a class='content-button' href='javascript:history.back()'>Takaisin</a></p>
                </div>";
          } 

          
          /* lähettää sähköpostilla vahvistuksen ja linkin perumissivulle
          (ei mahdollista shellissä)

          $viesti =
          'Pöytävarauksesi Imaginary Gastropubiin \n
          Päivämäärä: ' . $date .  '\n
          Kellonaika: ' . $time .  '\n
          Henkilömäärä: ' . $participants . '\n
          Varausnumerosi: ' . $reservationid . '\n
          Voit peruuttaa varauksesi <a href="http://shell.hamk.fi/~trtkm21a_15/gastropub/peruutus.html" target="_blank">Tällä sivulla</a>';

          mail($email, "Pöytävarauksesi", $viesti);
          */
          
        ?>

      </div>
    </div>
  </div>
</main>

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
