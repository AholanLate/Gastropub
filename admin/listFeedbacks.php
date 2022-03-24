<?php
  session_start();
  if (!isset($_SESSION['loggedin']))
  {
    header('location: login.php');
    exit;
  }
?>

<?php
$title = "IGP - Palautteet";
include('header.php');
?>

<script>

    function load(id){

    if (confirm("Haluatko varmasti poistaa palautteen?")){

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange=function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("textArea-" + id).innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "deleteFeedback.php?id=" + id, true);
    xhttp.send();
  }
}
</script>

<?php 
// yhteys
include('../configs/dbConfigs.php'); 
?>

<h1>Palautteet</h1>
<p><a class="content-button" href="javascript:history.back()">palaa etusivulle</a></p>

<?php

$sql = "SELECT * FROM gastropub_feedback ORDER BY id desc";

$stmt = $pdo->prepare($sql);

$stmt->execute();

// Haetaan kaikki rivit
$rivit = $stmt -> fetchAll();
?>



<?php
// Jos ei palautteita
  if (count($rivit)== 0){
    echo '<p>Ei palautteita</p>';
  }

  // muussa tapauksessa tulostaa varaukset
  else {

  foreach( $rivit as $rivi ) {

    echo '<div class="reservation-card">';
    echo '<div id= "textArea-' . $rivi['id'] . '">';
        echo '<p><b> Nimi:</b> ' . $rivi['name'] . '</p>';
        echo '<p><b> Sähköposti:</b> ' . $rivi['email'] . '</p>';
        $timeformat = date_create($rivi['datetime']);
        echo '<p><b> Aika:</b> ' . date_format($timeformat, 'd.m.Y H.i') . '</p>';
        echo '<p><b> Palaute:</b> ' . $rivi['feedback'] . '</p>';

        // poisto ajaxilla, varmistaa haluatko poistaa
        echo '<p><a class="content-button" href="javascript:load(\'' . $rivi['id'] . '\')">' . 'Poista' . '</a></p>' ;
        

    echo '</div>';
    echo '</div>';
}
}

  // listauksen loppuun myös paluunappi

  if (count($rivit)>1){
    echo '<p><a class="content-button" href="javascript:history.back()">Palaa etusivulle</a></p>';
  }

// Suljetaan yhteys
$pdo->connection = null;

?>

<?php
include('footer.php');
?>
