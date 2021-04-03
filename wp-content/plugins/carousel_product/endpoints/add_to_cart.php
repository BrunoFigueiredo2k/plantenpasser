<?php
$products = $_REQUEST["products"];
$quantity = $_REQUEST["quantity"];

foreach ($products as $key => $product_id) {
    WC()->cart->add_to_cart( $product_id, $quantity );
}