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
  ?>
    <?php 

      $data = array(
        'plants' => array(),
        'pots' => array()
      );
      
      array_push($data['plants'], get_all_plants());
      array_push($data['pots'], get_all_pots());
    ?>

    <?php 
      foreach ($data as $key => $value) {
        ?>
        <!-- Carousel -->
        <div class="slideshow-container mt-4">

          <!-- Loop through the plants and display in carousel -->
          <?php
          $carousel_product_class = "product-".strval(uniqid());

          $numItems = count($data[$key][0]);
          $i = 0;
          foreach ($data[$key][0] as $key => $product) { ?>
            <div class="<?php echo $carousel_product_class?> mySlides fade" style="display: <?php 
              // Displays only the last item as 'block', this is the first product seen in carousel
              if(++$i === $numItems) { echo "block"; } else { echo "none;"; };
            ?>">
              <h1 class="text-center" style="margin: 20px 0;"><?php echo $product['name']; ?></h1>
              <img src="<?php echo $product['img_url']; ?>" style="max-height: 300px;">
            </div>
          <?php } ?>

          <!-- Convert php variable for the classname to js so that we can use it in onclick function plusSlides as param -->
          <?php php_to_javascript_variables(array("carousel_product_class" => $carousel_product_class)); ?>

          <!-- Next and previous buttons -->
          <a class="prev" onclick="return plusSlides(-1, carousel_product_class)">&#10094;</a>
          <a class="next" onclick="return plusSlides(1, carousel_product_class)">&#10095;</a>
        </div>

        <?php
        //TODO: fix this rendering of both carousels
        break;
      }
    ?>

    <?php include_component(JS_COMPONENTS_DIR . 'carousel.js'); ?>
      
    <?php
}