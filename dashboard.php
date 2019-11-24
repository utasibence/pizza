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
  <meta http-equiv="content-type" content="text/html" charset="UTF-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
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
        <form class="" action="includes/logout.inc.php" method="post">
          <button type="submit" name="submit" class="btn btn-light">Kijelentkezés</button>
        </form>
      </div>
    </div>
  </header>

  <main role="main">



    <div class="album py-5 bg-light">
      <div class="container">

        <div class="row">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Vásárló ID</th>
                <th>Név</th>
                <th>Lakcím</th>
                <th>Telefon</th>
                <th>Pizza</th>
                <th>Darab</th>
                <th>Fizetendő ár (Ft)</th>
                <th>Dátum</th>
                <th>Idő</th>
              </tr>
            </thead>
          <?php

          try {
            $stmt = $conn->prepare("SELECT orders.id, orders.name, orders.address, orders.tel, orders.price, orders.date, pizza.name, orders_pizza.db FROM orders INNER JOIN orders_pizza ON orders.id=orders_pizza.order_id INNER JOIN pizza ON orders_pizza.pizza_id=pizza.id ORDER BY date DESC");
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($order_id, $order_name, $order_address, $order_tel, $order_price, $order_date, $pizza_name, $pizza_amount);

            $prev_id = 0;
            if ($stmt->num_rows > 0) {
              while ($stmt->fetch()) {
                $order_date = explode(" ", $order_date);
                $order_date[1] = explode(":", $order_date[1]);
                if ($prev_id == $order_id) {
                  echo '<tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>'.$pizza_name.'</td>
                          <td>'.$pizza_amount.'</td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>';
                } else {
                  echo '<tr class="newline">
                          <td class="orderid">'.$order_id.'</td>
                          <td>'.$order_name.'</td>
                          <td>'.$order_address.'</td>
                          <td>'.$order_tel.'</td>
                          <td>'.$pizza_name.'</td>
                          <td>'.$pizza_amount.'</td>
                          <td>'.$order_price.'</td>
                          <td>'.$order_date[0].'</td>
                          <td>'.$order_date[1][0].":".$order_date[1][1].'</td>
                        </tr>';
                }

                $prev_id = $order_id;
              }
            }
          } catch (Exception $e) {
            echo "Hiba történt a rendelések megjelenítésekor!";
          }
          ?>

          </table>
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
  <script src="script.js" charset="utf-8"></script>

</body>

</html>
