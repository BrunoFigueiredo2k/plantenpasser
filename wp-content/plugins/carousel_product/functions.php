<?php
/*
    Plugin Name: Plantenpasser - Carousel Product
    Plugin URI: https://plantenpasser.nl/
    Description: Custom carousel plants and pots product page
    Author: plantenpasser
    Author URI: plantenpasser.nl
    Version: 1.0
*/

define('PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CSS_COMPONENTS_DIR', PLUGIN_DIR . 'css_components/');
define('JS_COMPONENTS_DIR', PLUGIN_DIR . 'js_components/');

add_shortcode('carousel_shortcode', 'product_carousel');
function product_carousel(){
  include_component(CSS_COMPONENTS_DIR . 'carousel.css');
  ?>
    <?php 
      // Data model
      $data = array(
        'plants' => array(
          'name' => '',
          'price' => '',
          'length' => '',
          'width' => '',
          'img_url' => '',
        ),
        'pots' => array(
          'name' => '',
          'price' => '',
          'length' => '',
          'width' => '',
          'color' => '',
          'img_url' => '',
        )
      );
    ?>

    <!-- Slideshow container -->
    <div class="slideshow-container">
    
      <!-- Full-width images with number and caption text -->
      <?php
      foreach ($data['plants'] as $key => $plant) { ?>
        <div class="mySlides fade">
          <img src="<?php $plant['img_url'] ?>">
        </div>
      <?php } ?>
      
<!--     
      <div class="mySlides fade">
        <img src="http://localhost/plantenpassernl/wp-content/uploads/2021/03/plant-300x300.jpg">
        <div class="text">Caption Two</div>
      </div> -->
    
      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <?php include_component(JS_COMPONENTS_DIR . 'carousel.js'); ?>
      
    <?php
}