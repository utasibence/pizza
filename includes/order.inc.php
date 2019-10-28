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
          $order .= $db." db ".$pizza->getName().", ";
          $fullPrice += $pizza->getPrice() * $db;
        }
      }
    }

    $stmt = $conn->prepare("INSERT INTO orders (name, address, tel, pizzas, price, date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $address, $tel, $order, $fullPrice, $date);
    $stmt->execute();
    $stmt->store_result();
  } else {
    echo "empty input";
  }

  // TODO: hibakezelés, esetleg a rendelést és a vásárlót külön táblákra bontani
} else {
  //TODO: esetleges callback megvalósítása js-ben
  //https://www.w3schools.com/jquery/jquery_ajax_load.asp
}
