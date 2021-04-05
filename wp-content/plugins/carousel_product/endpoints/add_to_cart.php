<?php
define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
$path = preg_replace('/wp-content.*$/','',__DIR__);
include($path.'wp-load.php');

$products = $_GET["products"];
$quantity = $_GET["quantity"];

if(!isset(WC()->cart)) {
    echo "Something went wrong with theme imports, WC class not set.";
} else {
    foreach ($products as $key => $product_id) {
        try {
            WC()->cart->add_to_cart( $product_id, $quantity );
        } catch (\Throwable $th) {
            echo "error: ".$th;
        }
    }
}