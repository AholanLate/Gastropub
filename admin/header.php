<!DOCTYPE html>
<html lang="fi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo $title; ?></title>
  <link rel="icon" type="image/x-icon" href="../images/igp-dark.svg">
  <!--Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--Own CSS-->
  <link rel="stylesheet" href="../styles.css">
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
    <?php include('navbar.php'); ?>

    <!--HEADER-->
    <header>
      <div class="row">
        <div class="col-md-12">
          <div class="banner">
            <img class="header-image img-fluid" src="../images/gastropubheader.jpg" alt="Banneri">
            <img id="logo" class="img-fluid" src="../images/gastropublogo.svg" alt="Yrityksen logo">
          </div>
        </div>
      </div>
    </header>

    <!--MAIN-->
     <main>
      <!--INGRESSI-->
      <div class="row">
        <div class="col-md-12">
          <div class="content">