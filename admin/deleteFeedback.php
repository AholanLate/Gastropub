<?php
  session_start();
  if(!isset($_SESSION['loggedin']))
  {
    header('location: login.php');
    exit;
  }  
?>

<?php 
// yhteys
include('../configs/dbConfigs.php'); 
?>

<?php

$sql = "DELETE FROM gastropub_feedback WHERE id=? LIMIT 1";

$stmt = $pdo->prepare($sql);

// Saa urlissa id:n
$id= $_GET['id'];

$stmt->execute([$id]);



// Suljetaan yhteys
$pdo->connection = null;

echo '<p>Palaute poistettu onnistuneesti</p>';
?>
