<?php
  include_once 'includes/dbh.inc.php';
  include_once 'includes/functions.inc.php';
?>

<!DOCTYPE html>
<html lang="hu">

<head>
  <meta http-equiv="content-type" content="text/html" charset="UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <title>Pizza rendelés</title>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="album.css" rel="stylesheet">

</head>

<body cz-shortcut-listen="true">
  <header>
    <div class="collapse bg-dark" id="navbarHeader">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 col-md-7 py-4">
            <h4 class="text-white">Kapcsolat</h4>
            <p class="text-white">Cím: 6725 Szeged, Endre utca 11.</p>
            <p class="text-white">Telefon: <a href="tel:+36302746718">+36302746718</a></p>
            <p class="text-white">Email: <a href="mailto:info@pizza.com">info@pizza.com</a></p>
          </div>
          <div class="col-sm-4 offset-md-1 py-4">
            <h4 class="text-white">Bejelentkezés</h4>
            <form class="" action="includes/login.inc.php" method="post">
              <input type="email" id="inputEmail" name="email" class="form-control email" placeholder="Email">
              <input type="password" id="inputPassword" name="passwd" class="form-control password" placeholder="Jelszó">
              <button class="btn btn-lg btn-block login-btn btn-light" type="submit" name="submit">Bejelentkezés</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" id="cart" class="navbar-brand d-flex align-items-center">
          <i class="fas fa-shopping-cart"></i>
          <span class="cart-num">0</span>
        </a>

        <!-- Modal -->
        <div class="modal" id="myCart" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Rendelés</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="cart-order-list">

                </div>
                <form action="includes/order.inc.php" method="post">
                  <input type="text" name="name" id="nameCart" class="form-control order" placeholder="Teljes név">
                  <input type="text" name="address" id="addressCart" class="form-control order" placeholder="Lakcím">
                  <input type="text" name="phone" id="phoneCart" class="form-control order" placeholder="Telefonszám">
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" id="emptyCart" class="btn btn-secondary" data-dismiss="modal">Kosár ürítése</button>
                <button type="submit" name="submit" id="submit" class="btn buy-btn">Megrendel</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->

        <a href="index.php"><i class="fas fa-pizza-slice"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </div>
  </header>

  <main role="main">
    <div class="album py-5 bg-light">
      <div class="container">

        <!-- Alert -->
        <?php
        $html = "";
        if (isset($_GET['login'])) {
          switch ($_GET['login']) {
            case 'empty':
              $html = "Bejelentkezéshez töltsön ki minden mezőt!";
              break;
            case 'invalid_password':
              $html = "Bejelentkezéskor helytelen jelszót adott meg!";
              break;
            case 'invalid_email':
              $html = "Bejelentkezéskor helytelen email címet adott meg!";
              break;
            case 'error':
              $html = "Bejelentkezéskor hiba lépett fel!";
              break;
          }
          echo '<div class="alert alert-warning alert-dismissible hidden" role="alert">
            <span>'.$html.'</span>
            <button type="button" class="close" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
        ?>
        <div class="alert alert-secondary alert-dismissible hidden" role="alert">
          <span id="results"></span>
          <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Alert -->

        <div class="row">

          <?php
            try {
              $pizzas = array();
              $stmt = $conn->prepare("SELECT id, name, price, toppings, img FROM pizza ORDER BY id");
              $stmt->execute();
              $stmt->store_result();
              $stmt->bind_result($pizza_id, $pizza_name, $pizza_price, $pizza_toppings, $pizza_img);

              if ($stmt->num_rows > 0) {
                  while ($stmt->fetch()) {
                      printPizza($pizza_id, $pizza_name, $pizza_price, $pizza_toppings, $pizza_img);
                  }
              }
            } catch (Exception $e) {
              echo "Hiba történt a pizzák megjelenítésekor!";
            }
          ?>

        </div>
      </div>
    </div>

  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right back-to-top">
        <a href="#"><i class="fas fa-sort-up"></i></a>
      </p>
    </div>
  </footer>
  <script src="https://kit.fontawesome.com/ced4a0d58f.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="bootstrap.js"></script>
  <script src="script.js"></script>

</body>

</html>
