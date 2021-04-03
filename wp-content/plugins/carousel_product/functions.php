<?php
/*
    Plugin Name: Plantenpasser - Carousel Product
    Plugin URI: https://plantenpasser.nl/
    Description: Custom carousel plants and pots product page
    Author: plantenpasser
    Author URI: plantenpasser.nl
    Version: 1.0
*/
/** GLOBALS */
define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSS_COMPONENTS_DIR', PLUGIN_DIR . 'components/css/');
define('JS_COMPONENTS_DIR', PLUGIN_DIR . 'components/js/');
define('HTML_COMPONENTS_DIR', PLUGIN_DIR . 'components/html/');

/** IMPORTS */
require(ABSPATH . 'wp-content/plugins/plantenpasser_library/Model/Plant.php');
require(ABSPATH . 'wp-content/plugins/plantenpasser_library/Model/Pot.php');

/** Shortcode product carousel and product data for frontend */
add_shortcode('carousel_shortcode', 'product_carousel');
function product_carousel(){
  include_component(CSS_COMPONENTS_DIR . 'carousel.css');
  include_component(JS_COMPONENTS_DIR . 'carousel.js');
  include_component(JS_COMPONENTS_DIR . 'cart.js');
  ?>
    <?php 
      $data = array(
        'plants' => array(),
        'pots' => array()
      );

      array_push($data['plants'], get_products('plants'));
      array_push($data['pots'], get_products('pots'));
    ?>

</div>
  <div class="row">
    <div class="col-lg-6">
      <?php foreach ($data as $key => $value) { ?>
        <!-- Carousel -->
        <div class="slideshow-container mt-4">
          <!-- Loop through the plants and display in carousel -->
          <?php
          $category = $key;

          $carousel_slides_class = "slides-".$category;

          // Convert php variable for the classname to js so that we can use it in onclick function plusSlides as param
          php_to_javascript_variables(array("carousel_slides_class_{$category}" => $carousel_slides_class));
          ?>
          <!-- Next and previous buttons -->
          <a class="prev" onclick="return plusSlides(-1, carousel_slides_class_<?php echo $category ?>)">&#10094;</a>
          <a class="next" onclick="return plusSlides(1, carousel_slides_class_<?php echo $category ?>)">&#10095;</a>

          <script>
            // Display the current carousel items stats to the page
            // TODO: still not completely correct at first
            document.addEventListener("DOMContentLoaded", function(){
              updateProductData(carousel_slides_class_<?php echo $category ?>);
            });
            </script>

          <?php
          // Keeping count of index to determine whether last product in loop later
          $numItems = count($data[$key][0]);
          $i = 0;

          // Declare empty arrays of product info per category
          $product_names = $product_prices = $product_descriptions = [];

          ?> 
          <?php
          foreach ($data[$key][0] as $key => $product) { 
            $modal_id = "exampleModalCenter".$product['product_id'];
            ?>
            <div class="<?php echo $carousel_slides_class?> mySlides fade" style="display: <?php 
              // Displays only the last item as 'block', this is the first product seen in carousel
              if(++$i === $numItems) { echo "block"; } else { echo "none;"; }; ?>">
              <img src="<?php echo $product['img_url']; ?>" alt="<?php echo $product['name']; ?>" class="carousel-image" 
              data-toggle="modal" data-target="#<?php echo $modal_id;?>">
              <p class="bottom-carousel">
                <span class="name-product"><?php echo $product['name'];?></span>
                <span class="price-product"><?php echo $product['price']. " EUR"; ?></span>                  
              </p>
            </div>

            <!-- Modal image view -->
            <div class="modal fade" id="<?php echo $modal_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="padding: 54%; background: url(<?php echo $product['img_url']; ?>); 
                  background-size: cover; background-repeat: no-repeat;">
                </div>
              </div>
            </div>

            <?php 
            // Push names and prices to the category js object
            array_push($product_names, $product['name']);
            array_push($product_prices, floatval($product['price']));
            array_push($product_descriptions, $product['description']);
          }

          // Convert object of prices and names of category to js object
          php_to_javascript_variables(array("obj_{$category}" => array(
            'names' => $product_names, 
            'prices' => $product_prices,
            'descriptions' => $product_descriptions
          )));
          ?>

        </div>
      <?php } ?>
    </div> <!-- col-lg-6 -->
    <?php display_product_data(); ?>
  </div> <!-- row -->
  <?php
}

function display_product_data(){
  ?>
    <div class="col-lg-6">
      <!-- Product info such as price comes here -->
      <h2 id="name-products"></h2><br>
      <p id="description"></p><br>
      <h4 id="total-price"></h4><br>

      <!-- Add to cart functionality -->
      <!-- TODO: fix the endpoint functionality and DOM manipulation total price -->
      <form action="">
        <input type="hidden" name="total_price">
        <div class="product-quantity" data-title="Quantity">
          <div class="quantity">
            <div class="bizberg-shop-quantity">
              <button type="button" class="minus" onclick="updateAmountTotal(-1)">-</button>	
              <input type="number" id="quantity-product" onkeyup="updateAmountTotal(0)" class="input-text qty text" step="1" min="1" max="" name="cart[1534b76d325a8f591b52d302e7181331][qty]" value="1" title="Qty" size="4" placeholder="" inputmode="numeric">
              <button type="button" class="plus" onclick="updateAmountTotal(1)">+</button>
            </div>	
          </div>
        </div><br>
        <!-- TODO: add to cart functionality with correct params -->
        <button onclick="addToCart('test')" class="btn-submit">Toevoegen aan winkelwagen</button>
      </form>
    </div> <!-- col-lg-6 -->
  <?php
}