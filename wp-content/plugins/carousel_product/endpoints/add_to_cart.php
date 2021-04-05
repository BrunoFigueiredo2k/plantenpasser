<?php
define( 'WP_USE_THEMES', false ); // Don't load theme support functionality
$path = preg_replace('/wp-content.*$/','',__DIR__);
include($path.'wp-load.php');

$products = $_GET["products"];
$quantity = $_GET["quantity"];

if(!isset(WC()->cart)) {
    echo "Something went wrong with theme imports, WC class not set.";
} else {
    $prod_combination_ids = [];

    foreach ($products as $key => $product_id) {
        try {
            // Add product to cart
            WC()->cart->add_to_cart( $product_id, $quantity );
            // Push product to array to create combination later
            array_push($prod_combination, $product_id);
        } catch (\Throwable $th) {
            echo "error: ".$th;
        }
    }

    // Create combination
    createProductCombinations($prod_combination_ids[0], $prod_combination_ids[1]);
}

function createProductCombinations($plant_id, $pot_id){
    // Create connection
    $conn = new mysqli("localhost", "root", "", "planten-passer-nl");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO plant_pot_combis (plant_id, pot_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $plant, $pot);
    $plant = $plant_id;
    $pot = $pot_id;
    $stmt->execute();

    $stmt->close();
    $conn->close();
}