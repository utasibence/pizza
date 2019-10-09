<?php
  session_start();

  if (!isset($_SESSION['email']) || !isset($_SESSION['name'])) {
    header("Location: index.php?login=error");
  }

  include_once 'includes/dbh.inc.php';
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Utasi Bence, Gábor Milán, Bódi Dominik">

  <title>Pizza rendelés</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="album.css" rel="stylesheet">
</head>

<body>
  <header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#"><?php echo $_SESSION['name'];?></a>
        <a href="index.php"><i class="fas fa-pizza-slice"></i></a>
        <a href="#"><i class="fas fa-sign-out-alt"></i></a>
      </div>
    </div>
  </header>

  <main role="main">



    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">


          <?php
            //Táblázatok generálása
          ?>

        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right back-to-top">
        <a href="#">top <i class="fas fa-sort-up"></i></a>
      </p>
    </div>
  </footer>
  <script src="https://kit.fontawesome.com/ced4a0d58f.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="bootstrap.js"></script>

</body>

</html>
