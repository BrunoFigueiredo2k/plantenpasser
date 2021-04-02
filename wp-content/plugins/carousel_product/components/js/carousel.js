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
  let title = obj_pots.names[counters[0]] + " & " + obj_plants.names[counters[1]];
  document.getElementById('name-products').innerHTML = title;

  let totalPrice = obj_pots.prices[counters[0]] + obj_plants.prices[counters[1]];
  document.getElementById('total-price').innerHTML = `<b>Total:</b> ${totalPrice} EUR`;

  document.getElementById('description').innerHTML = `
    <b>Plant:</b> ${obj_plants.descriptions[counters[1]]}<br><br>
    <b>Pot: </b> ${obj_pots.descriptions[counters[0]]}
  `;
}