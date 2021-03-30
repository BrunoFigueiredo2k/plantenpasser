<?php
/**  */
function google_site_tag() {
    ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src='https://www.googletagmanager.com/gtag/js?id=G-Q0XBX219F5'></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-Q0XBX219F5');
        </script>
    <?php
}

// Add to admin and front end head
add_action( 'admin_head', 'google_site_tag' );
add_action( 'wp_head', 'google_site_tag' );