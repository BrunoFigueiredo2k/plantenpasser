let slideIndex = 1;

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

  updateProductData(n);
}

function updateProductData(n){
  // TODO: fix the index 
  // Showing product info on change carousel
  let title = obj_plants.names[n] + " & " + obj_pots.names[n];
  document.getElementById('names-products').innerText = title;

  let totalPrice = obj_plants.prices[n] + obj_plants.prices[n];
  document.getElementById('total-price').innerText = "Total: " + totalPrice + " EUR";
}