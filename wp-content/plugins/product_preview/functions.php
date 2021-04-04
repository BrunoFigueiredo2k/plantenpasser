<?php
    /*
        Plugin Name: Plantenpasser - Product previewer
        Plugin URI: https://plantenpasser.nl/
        Description: Preview your plant and pot combination with uploaded image, stats, modal and tabs information product.
        Author: plantenpasser
        Author URI: plantenpasser.nl
        Version: 1.0
    */

    /* Globals */
    define("PRODUCT_PREVIEW_PLUGIN_DIR", plugin_dir_path(__FILE__));
    define("PRODUCT_PREVIEW_COMPONENTS_DIR", PRODUCT_PREVIEW_PLUGIN_DIR . "components/");

    /* Shortcodes */
    add_shortcode("product_preview", "render_product_preview");

    function render_product_preview() {
        include_component(PRODUCT_PREVIEW_COMPONENTS_DIR . "html/preview-window.html");
    }
?>