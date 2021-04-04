// Global variables
let totalPrice;
let counterAmountTotal = 1;
let slideIndex = 1;
let counters = [0, 0];
let indexes = [0, 0]

// Next/previous controls
function plusSlides(n, className) {
  showSlides(slideIndex += n, className);
}

function showSlides(n, className) {
  let i;
  let slides = document.getElementsByClassName(className);

  // Determine whether left or right button click
  if (n > slides.length) slideIndex = 1;
  if (n < 1) slideIndex = slides.length;
  
  // Display next item and hide all others
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";

  updateProductData(className);
}

function updateProductData(className){
  // Set counter for each category
  if (className.includes('pots')){
    counters[0] = slideIndex - 1;
  } else if (className.includes('plants')){
    counters[1] = slideIndex - 1;
  }
  
  // Showing product info on change carousel
  let title = obj_plants.names[counters[1]] + " & " + obj_pots.names[counters[0]];
  document.getElementById('name-products').innerHTML = title;

  totalPrice = obj_pots.prices[counters[0]] + obj_plants.prices[counters[1]];
  document.getElementById('total-price').innerHTML = `<b>Totaal:</b> <span id="total-price-value">${totalPrice * counterAmountTotal}</span> EUR`;

  document.getElementById('description').innerHTML = `
    <div class="card-product-info">
      <h4 class="title">Plant</h4>
      ${obj_plants.descriptions[counters[1]]}
      <hr>
      <h4 class="title">Pot</h4>
      ${obj_pots.descriptions[counters[0]]}
    </div>
  `;
}

function updateAmountTotal(n){
  // If counter is already at one and user clicks minus then dont subtract (minimum is 1)
  if (counterAmountTotal == 1 && n == -1) return;

  // If counter argument passed is 0 then that means user has changed number in input field so we set the counter to that value
  if (n == 0) {
    counterAmountTotal = Math.round((document.getElementById('quantity-product').value) * 100) / 100;
  } else {
    counterAmountTotal += n; // Else we add the passed argument to the value
  }

  if (document.getElementById('quantity-product').value < 0) {
    document.getElementById('quantity-product').value = 1;
    return;
  }

  // Update total price
  document.getElementById('total-price-value').innerText = Math.round((totalPrice * counterAmountTotal) * 100) / 100
}