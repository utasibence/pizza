function emptyCart(order) {
  for (var key in order) {
      delete order[key];
  }

  var inputs = $('input');
  for (var i in inputs) {
    inputs[i].value = "";
  }

  updateCartCount(order);
  console.log("Kosár kiürítve!");
  $('#myCart').hide();
}

function updateCartCount(order) {
  var sum = 0;
  for (var key in order) {
      sum += parseInt(order[key]);
  }
  $('.cart-num').html(sum);
}

$(document).ready(function(){
  var inputs = $('input');

  for (var i in inputs) {
    inputs[i].value = "";
  }

  var order = {};

  $('#cart').on('click', function(){
    $('#myCart').show();
    $('#myCart .cart-order').load("includes/calc.inc.php", {order: order});
  });

  $('.card .buy-btn').on('click', function(e){
    e.preventDefault();
    var pizza = $(this).parent().siblings('h5').attr('data');
    var amount = $(this).prev().val();
    if (amount > 0) {
      order[pizza] = amount;
      console.log(amount + " db " + $(this).parent().siblings('h5').html() + " hozzáadva a kosárhoz!");
    }
    console.log(order);
    updateCartCount(order);
  });

  $('.close').on('click', function(){
    $('#myCart').hide();
  });

  $('#emptyCart').on('click', function(){
    emptyCart(order);
  });
});
