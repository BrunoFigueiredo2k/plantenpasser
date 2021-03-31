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

/** ----------- REQUIRE MODELS ----------- */