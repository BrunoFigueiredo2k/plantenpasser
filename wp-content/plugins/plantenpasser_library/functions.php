<?php
/*
    Plugin Name: Plantenpasser - Library
    Plugin URI: https://plantenpasser.nl/
    Description: Library of plantenpasser developer team (all reusable functions, classes, etc.)
    Author: plantenpasser
    Author URI: plantenpasser.nl
    Version: 1.0
*/
/** ----------- GLOBALS ----------- */


/** ----------- FUNCTIONS ----------- */
/** Includes components from passed directory (html, css, js) */
function include_component($abs_file_dir) {
    $content = file_get_contents($abs_file_dir);
    $exploded_dir_path = explode(".", $abs_file_dir);
    $extension = strtolower($exploded_dir_path[count($exploded_dir_path ) - 1]);
  
    // Check content type
    switch ($extension) {
      case 'html':
        echo $content;
        break;
      case 'js':
        echo "<script>".$content."</script>";
        break;
      case 'css':
        echo "<style>".$content."</style>";
        break;
    }
}

function get_products($category){
  $products = wc_get_products( array('category' => array( $category ),'orderby'  => 'name', 'limit' => 5) );
  $array_products = [];

  // Create new instance of each product in products array with the custom classes, then push them to array
  foreach ($products as $key => $product) {
    $product_obj = create_instance_custom_obj($category, $product);
    array_push($array_products, $product_obj->get_object());
  }

  return $array_products;
}

function create_instance_custom_obj($category, $product){
  $image_id  = $product->get_image_id();

  switch ($category) {
    case 'plants':
      return new Plant(
        $product->get_id(), 
        $product->get_name(), 
        $product->get_price(), 
        $product->get_length(), 
        $product->get_width(), 
        wp_get_attachment_image_url( $image_id, 'full' )
      );
    case 'pots':
      return new Pot(
        $product->get_id(), 
        $product->get_name(), 
        $product->get_price(), 
        $product->get_length(), 
        $product->get_width(), 
        'color', // TODO: color needs to be added as attribute
        wp_get_attachment_image_url( $image_id, 'full' ),
        $product->get_weight()
      );
  }
}

function php_to_javascript_variables($object) {
  // Open script tag
  echo "<script>\n";

  // Loop through the object and print depending on the variable type
  foreach($object as $property => $value) {
      echo "\t";

      // Determine the type of variable
      switch (gettype($value)) {
          case "string":
              echo "var {$property} = " . json_encode($value) . ";";
              break;
          case "integer":
              echo "var {$property} = " . addslashes($value) . ";";
              break;
          case "array":
              echo "var {$property} = JSON.parse(\"" . addslashes(json_encode($value)) . "\")";
              break;
          case "object":
              echo "var {$property} = JSON.parse(\"" . addslashes(json_encode($value)) . "\")";
              break;
          default:
              echo "console.log(\"Unknown variable type: " . addslashes($property) . ");";
              break;
      }

      // Start writing on newline
      echo "\n";
  }

  // Close script tag
  echo "</script>";
}

/** ----------- REQUIRE MODELS ----------- */