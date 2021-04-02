<?php
/*
    Plugin Name: Plantenpasser - Carousel Product
    Plugin URI: https://plantenpasser.nl/
    Description: Custom carousel plants and pots product page
    Author: plantenpasser
    Author URI: plantenpasser.nl
    Version: 1.0
*/
/** IMPORTS */
require(ABSPATH . 'wp-content/plugins/plantenpasser_library/Model/Plant.php');
require(ABSPATH . 'wp-content/plugins/plantenpasser_library/Model/Pot.php');

/** GLOBALS */
define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSS_COMPONENTS_DIR', PLUGIN_DIR . 'components/css/');
define('JS_COMPONENTS_DIR', PLUGIN_DIR . 'components/js/');

/** Shortcode product carousel for frontend */
add_shortcode('carousel_shortcode', 'product_carousel');
function product_carousel(){
  include_component(CSS_COMPONENTS_DIR . 'carousel.css');
  include_component(JS_COMPONENTS_DIR . 'carousel.js');
  ?>
    <?php 
      $data = array(
        'plants' => array(),
        'pots' => array()
      );

      array_push($data['plants'], get_products('plants'));
      array_push($data['pots'], get_products('pots'));
    ?>

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

            <?php
            // Keeping count of index to determine whether last product in loop later
            $numItems = count($data[$key][0]);
            $i = 0;

            $product_names = [];
            $product_prices = [];
            $product_descriptions = [];

            foreach ($data[$key][0] as $key => $product) { ?>
              <div class="<?php echo $carousel_slides_class?> mySlides fade" style="display: <?php 
                // Displays only the last item as 'block', this is the first product seen in carousel
                if(++$i === $numItems) { echo "block"; } else { echo "none;"; };
              ?>">
                <img src="<?php echo $product['img_url']; ?>" style="max-height: 300px;">
                <p class="bottom-carousel">
                  <span class="name-product"><?php echo $product['name'];?></span>
                  <span class="price-product"><?php echo $product['price']. " EUR"; ?></span>                  
                </p>
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
      <div class="col-lg-6">
        <!-- Product info such as price comes here -->
        <h1 id="name-products"></h1><br>
        <p id="description"></p><br>
        <!-- TODO: php to js variable price of current active elements in carousel -->
        <h4 id="total-price"></h4>
      </div>
    </div> <!-- row -->

    <script> updateProductData(0); </script>
      
    <?php
}