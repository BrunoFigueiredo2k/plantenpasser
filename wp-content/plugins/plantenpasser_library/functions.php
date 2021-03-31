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

function get_all_plants(){
  // Get all plants by category
  $plants = wc_get_products( array('category' => array( 'plants' ),'orderby'  => 'name') );

  $array_plants = [];

  foreach ($plants as $key => $plant) {
    $image_id  = $plant->get_image_id();

    // Create new instance
    $plant_obj = new Plant(
      $plant->get_id(), 
      $plant->get_name(), 
      $plant->get_price(), 
      $plant->get_length(), 
      $plant->get_width(), 
      wp_get_attachment_image_url( $image_id, 'full' )
    );

    // Push object to array thats been passed as argument 
    array_push($array_plants, $plant_obj->get_object());
  }

  return $array_plants;
}

function get_all_pots(){
  // Get all pots by category
  $pots = wc_get_products( array('category' => array( 'pots' ),'orderby'  => 'name') );

  $array_pots = [];

  foreach ($pots as $key => $pot) {
    $image_id  = $pot->get_image_id();

    // Create new instance
    $pot_obj = new Pot(
      $pot->get_id(), 
      $pot->get_name(), 
      $pot->get_price(), 
      $pot->get_length(), 
      $pot->get_width(), 
      'color', // TODO: color needs to be added as attribute
      wp_get_attachment_image_url( $image_id, 'full' ),
      $pot->get_weight()
    );

    // Push object to array thats been passed as argument 
    array_push($array_pots, $pot_obj->get_object());
  }

  return $array_pots;
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