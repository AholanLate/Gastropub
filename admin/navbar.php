    <nav id="navbar-container" class="navbar-container">
      <div class="navbar-top">
        
        <div id="navbar-top-left">
          <a id="navbar-logo-button" href="../index.html"><img id="navbar-logo" src="../images/igp.svg" alt="Logo" title="Etusivu"></a>
        </div>

        <div id="navbar-top-right">
          <ul>
            <li>
              <!-- Linkki toimii JavaScriptin avulla, ks. koodi-admin.js -->
              <a id="hamburger-button" href="#">
                <img id="hamburger-icon" src="../images/Hamburger_icon.svg" alt="Valikko">
              </a>
            </li>
            <?php
            if(isset($_SESSION['loggedin']))
            {
              echo '<li><a id="reservation-link" class="navbar-link-admin" href="logout.php">Kirjaudu ulos</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>

      <!-- Piiloon menevä div, jossa linkit -->
      <div id="collapsible-div-admin" class="navbar-bottom">
        <ul>
          <li><a class="navbar-link-admin" href="index.php">Hallinta</a></li>
          <li><a class="navbar-link-admin" href="listReservations.php">Varaukset</a></li>
          <li><a class="navbar-link-admin" href="listFeedbacks.php">Palautteet</a></li>
          <li><a id="hidden-link" class="navbar-link-admin" href="logout.php">Kirjaudu ulos</a></li>
          <li><a class="navbar-link-admin" href="../index.html">Etusivu</a></li>
        </ul>
      </div>
    </nav>