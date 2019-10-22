<?php

class Pizza {
  private $id;
  private $name;
  private $price;
  private $toppings;

  public function __construct($id, $name, $price, $toppings) {
    $this->id = $id;
    $this->name = $name;
    $this->price = $price;
    $this->toppings = $toppings;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getToppings() {
    return $this->toppings;
  }
}
