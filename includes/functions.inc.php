<?php

function printPizza($pizza_id, $pizza_name, $pizza_price, $pizza_toppings, $pizza_img) {
  $result = '
  <div class="col-md-4">
    <div class="card mb-4 shadow-sm">
      <img src="img/'.$pizza_img.'" alt="Magyaros pizza">
      <div class="card-body">
        <h5 class="card-title" data="'.$pizza_id.'">'.$pizza_name.'</h5>
        <p class="card-text">'.$pizza_toppings.'</p>
        <div class="d-flex justify-content-between">
          <input type="number" name="pizzaCount" class="form-control pizzaCount">
          <a href="" class="btn buy-btn">
            <div class="con st">'.$pizza_price.' Ft</div>
		        <div class="con nd"><i class="fas fa-shopping-cart"></i></div>
          </a>
        </div>
      </div>
    </div>
  </div>';
  echo $result;
}
