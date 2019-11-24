<?php

include_once 'dbh.inc.php';
require 'pizza.inc.php';

if (isset($_POST['order'])) {
  if ( !empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['phone'])) {
    $order = "";
    $pizzas = array();
    $fullPrice = 0;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $tel = $_POST['phone'];
    $date = date("Y-m-d H:i");

    try {
      //lekérem az összes pizzát objektumokat hozok létre majd azon végzek műveleteket
      $stmt = $conn->prepare("SELECT id, name, price, toppings FROM pizza ORDER BY id");
      $stmt->execute();
      $stmt->store_result();
      $stmt->bind_result($pizza_id, $pizza_name, $pizza_price, $pizza_toppings);

      if ($stmt->num_rows > 0) {
        while ($stmt->fetch()) {
          array_push($pizzas, new Pizza($pizza_id, $pizza_name, $pizza_price, $pizza_toppings));
        }
      }

      foreach ($pizzas as $pizza) {
        foreach ($_POST['order'] as $value => $db) {
          if ($pizza->getId() == $value) {
            $fullPrice += $pizza->getPrice() * $db;
          }
        }
      }

      $stmt = $conn->prepare("INSERT INTO orders (name, address, tel, price, date) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sssss", $name, $address, $tel, $fullPrice, $date);
      $stmt->execute();
      $stmt->store_result();

      $last_id = $conn->insert_id;
      foreach ($pizzas as $pizza) {
        foreach ($_POST['order'] as $value => $db) {
          if ($pizza->getId() == $value) {
            $pizza_id = $pizza->getId();
            $stmt = $conn->prepare("INSERT INTO orders_pizza (order_id, pizza_id, db) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $last_id, $pizza_id, $db);
            $stmt->execute();
            $stmt->store_result();
          }
        }
      }

      echo "Sikeres rendelés. Megrendelési azonosítója: ".$last_id;
    } catch (Exception $e) {
      echo "Adatbázis kapcsolati hiba!";
    }
  } else {
    echo "Hiba! Kérem töltse ki az összes mezőt megrendeléskor!";
  }
} else {
  echo "Hiba! Adjon pizzát a kosárhoz!";
}
