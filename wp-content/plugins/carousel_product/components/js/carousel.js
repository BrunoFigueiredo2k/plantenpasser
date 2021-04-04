// Global variables
const heightSVG = `<svg aria-hidden="true" focusable="false" role="presentation" class="icon height" viewBox="0 0 35 35"><path d="M17.736 4.006a.974.974 0 0 0-.57.272l-3.843 3.734a.922.922 0 0 0-.323.672.923.923 0 0 0 .283.689.978.978 0 0 0 1.401-.049l2.202-2.139v21.633l-2.202-2.139a.98.98 0 0 0-.79-.282.958.958 0 0 0-.806.623.917.917 0 0 0 .235.972l3.843 3.733a.97.97 0 0 0 .68.275.97.97 0 0 0 .68-.275l3.843-3.733a.922.922 0 0 0 .323-.672.923.923 0 0 0-.283-.69.978.978 0 0 0-1.4.05l-2.202 2.138V7.185l2.201 2.14a.972.972 0 0 0 .69.318.978.978 0 0 0 .711-.27.923.923 0 0 0 .283-.69.922.922 0 0 0-.323-.671l-3.842-3.734a.975.975 0 0 0-.79-.272z"></path></svg>`;
const widthSVG = `<svg aria-hidden="true" focusable="false" role="presentation" class="icon width" viewBox="0 0 35 35"><path d="M32.186 17.882a1.044 1.044 0 0 0-.292-.611l-4-4.117a.988.988 0 0 0-.72-.346.99.99 0 0 0-.738.303 1.05 1.05 0 0 0 .052 1.501l2.292 2.359H5.6l2.292-2.359a1.05 1.05 0 0 0 .302-.847 1.027 1.027 0 0 0-.666-.863.981.981 0 0 0-1.042.252l-4 4.117a1.043 1.043 0 0 0-.295.729c0 .273.106.536.295.73l4 4.116a.988.988 0 0 0 .72.346.99.99 0 0 0 .738-.303c.194-.202.3-.478.29-.763a1.038 1.038 0 0 0-.342-.738L5.6 19.029h23.18l-2.292 2.359a1.048 1.048 0 0 0-.052 1.501.99.99 0 0 0 .738.303.988.988 0 0 0 .72-.346l4-4.117a1.04 1.04 0 0 0 .292-.847z"></path></svg>`;
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

function randomizeProductsCarousel(max){
  // Simulate click on next previous with random number for both carousels
  plusSlides(Math.floor(Math.random() * max), carousel_slides_class_plants);
  plusSlides(Math.floor(Math.random() * max), carousel_slides_class_pots);
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
      <h4 class="title">Plant</h4>
      ${obj_plants.descriptions[counters[1]]}<br>
      <ul class="horizontal-list">
        <li><span class="product-icon">${heightSVG}</span><b class="product-icon-txt">${obj_plants.lengths[counters[1]]} cm</b></li>
        <li><span class="product-icon">${widthSVG}</span><b class="product-icon-txt">${obj_plants.widths[counters[1]]} cm</b></li>
      </ul>

      <h4 class="title">Pot</h4>
      ${obj_pots.descriptions[counters[0]]}<br>
      <ul class="horizontal-list">
        <li><span class="product-icon">${heightSVG}</span><b class="product-icon-txt">${obj_pots.lengths[counters[0]]} cm</b></li>
        <li><span class="product-icon">${widthSVG}</span><b class="product-icon-txt">${obj_pots.widths[counters[0]]} cm</b></li>
      </ul>
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

  // Update total price
  document.getElementById('total-price-value').innerText = Math.round((totalPrice * counterAmountTotal) * 100) / 100
}