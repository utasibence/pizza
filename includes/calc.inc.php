<?php

include_once 'dbh.inc.php';

if (!isset($_POST['order'])) {
  header("Location: ../index.php?order=error");
  exit();
}
$order = $_POST['order'];
$pizzas = array();
$stmt = $conn->prepare("SELECT id, name, price, toppings, img FROM pizza ORDER BY id");
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($pizza_id, $pizza_name, $pizza_price, $pizza_toppings, $pizza_img);

if ($stmt->num_rows > 0) {
  while ($stmt->fetch()) {
    $pizza = ["id" => $pizza_id,"name" => $pizza_name, "price" => $pizza_price, "toppings" => $pizza_toppings, "img" => $pizza_img];
    array_push($pizzas, $pizza);
  }

  //formzáni az adatokat, hogy jól nézzen ki
  $osszeg = 0;
  foreach ($order as $key => $value) {
    $osszeg += $pizzas[$key-1]['price'] * $value;

    echo '<div class="">
            <h1>'.$pizzas[$key-1]['name'].'</h1>
            <p>'.$value . '*' . $pizzas[$key-1]['price'].'</p>
          </div>';
  }
  echo '<div>Összesen: '.$osszeg.'</div>';
}
