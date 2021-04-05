<?php
$products = $_POST["products"];
$quantity = $_POST["quantity"];

foreach ($products as $key => $product_id) {
    WC()->cart->add_to_cart( $product_id, $quantity );
}