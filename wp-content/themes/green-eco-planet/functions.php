<?php

add_action( 'wp_enqueue_scripts', 'green_eco_planet_chld_thm_parent_css' );
function green_eco_planet_chld_thm_parent_css() {

    wp_enqueue_style( 
    	'green_eco_planet_chld_css', 
    	trailingslashit( get_template_directory_uri() ) . 'style.css', 
    	array( 
    		'bootstrap',
    		'font-awesome-5',
    		'bizberg-main',
    		'bizberg-component',
    		'bizberg-style2',
    		'bizberg-responsive' 
    	) 
    );
    
}

/**
* Changed the blog layout to 3 columns
*/
add_filter( 'bizberg_sidebar_settings', 'green_eco_planet_sidebar_settings' );
function green_eco_planet_sidebar_settings(){
	return '4';
}

/**
* Change the theme color
*/
add_filter( 'bizberg_theme_color', 'green_eco_planet_change_theme_color' );
add_filter( 'bizberg_header_menu_color_hover_sticky_menu', 'green_eco_planet_change_theme_color' );
add_filter( 'bizberg_header_button_color_sticky_menu', 'green_eco_planet_change_theme_color' );
add_filter( 'bizberg_header_button_color_hover_sticky_menu', 'green_eco_planet_change_theme_color' );
function green_eco_planet_change_theme_color(){
    return '#1DB954';
}

add_filter( 'bizberg_header_button_border_color', 'green_eco_planet_btn_border_color' );
add_filter( 'bizberg_header_button_border_color_sticky_menu', 'green_eco_planet_btn_border_color' );
function green_eco_planet_btn_border_color(){
    return '#478a41';
}

/**
* Change the header menu color hover
*/
add_filter( 'bizberg_header_menu_color_hover', 'green_eco_planet_header_menu_color_hover' );
function green_eco_planet_header_menu_color_hover(){
    return '#1DB954';
}

/**
* Change the button color of header
*/
add_filter( 'bizberg_header_button_color', 'green_eco_planet_header_button_color' );
function green_eco_planet_header_button_color(){
    return '#1DB954';
}

/**
* Change the button hover color of header
*/
add_filter( 'bizberg_header_button_color_hover', 'green_eco_planet_header_button_color_hover' );
function green_eco_planet_header_button_color_hover(){
    return '#1DB954';
}

add_filter( 'bizberg_slider_title_box_highlight_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_slider_arrow_background_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_slider_dot_active_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_slider_gradient_primary_color', function(){
    return 'rgba(106,180,62,0.65)';
});

add_filter( 'bizberg_read_more_background_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_read_more_background_color_2', function(){
    return '#1DB954';
});

add_filter( 'bizberg_link_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_link_color_hover', function(){
    return '#1DB954';
});

add_filter( 'bizberg_blog_listing_pagination_active_hover_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_sidebar_widget_link_color_hover', function(){
    return '#1DB954';
});

add_filter( 'bizberg_sidebar_widget_title_color', function(){
    return '#1DB954';
});

add_filter( 'bizberg_footer_social_icon_background', function(){
    return '#1DB954';
});

add_filter( 'bizberg_footer_social_icon_color', function(){
    return '#fff';
});

/** #### CUSTOM STUFF #### */
/** ------------------ ADD GOOGLE ANALYTICS TO HEAD ------------------*/
function google_site_tag() {
    echo "
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src='https://www.googletagmanager.com/gtag/js?id=G-Q0XBX219F5'></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        
        gtag('config', 'G-Q0XBX219F5');
        </script>
    ";
}

// Add to admin and front end head
add_action( 'admin_head', 'google_site_tag' );
add_action( 'wp_head', 'google_site_tag' );

add_shortcode('carousel_shortcode', 'product_carousel');
function product_carousel(){
    echo '
    <style>
    .mySlides {display: none}
    img {vertical-align: middle;}

    .mySlides img{
        margin: 0 auto;
    }
    
    /* Slideshow container */
    .slideshow-container {
      max-width: 1000px;
      position: relative;
      margin: auto;
    }
    
    /* Next & previous buttons */
    .prev, .next {
      cursor: pointer;
      position: absolute;
      top: 50%;
      width: auto;
      padding: 16px;
      margin-top: -22px;
      color: white;
      font-weight: bold;
      font-size: 18px;
      transition: 0.6s ease;
      border-radius: 0 3px 3px 0;
      user-select: none;
      background: black;
    }
    
    /* Position the "next button" to the right */
    .next {
      right: 0;
      border-radius: 3px 0 0 3px;
    }
    
    /* On hover, add a black background color with a little bit see-through */
    .prev:hover, .next:hover {
      background-color: rgba(0,0,0,0.8);
    }
    
    /* Caption text */
    .text {
      color: #f2f2f2;
      font-size: 15px;
      padding: 8px 12px;
      position: absolute;
      bottom: 8px;
      width: 100%;
      text-align: center;
    }
    
    /* Number text (1/3 etc) */
    .numbertext {
      color: #f2f2f2;
      font-size: 12px;
      padding: 8px 12px;
      position: absolute;
      top: 0;
    }
    
    /* Fading animation */
    .fade {
      -webkit-animation-name: fade;
      -webkit-animation-duration: 1.5s;
      animation-name: fade;
      opacity: 1;
      animation-duration: 1.5s;
    }
    
    @-webkit-keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }
    
    @keyframes fade {
      from {opacity: .4} 
      to {opacity: 1}
    }
    
    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
      .prev, .next,.text {font-size: 11px}
    }
    </style>

    <!-- Slideshow container -->
    <div class="slideshow-container">
    
      <!-- Full-width images with number and caption text -->
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="http://localhost/plantenpassernl/wp-content/uploads/2021/03/pot.jpg">
        <div class="text">Caption Text</div>
      </div>
    
      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="http://localhost/plantenpassernl/wp-content/uploads/2021/03/plant-300x300.jpg">
        <div class="text">Caption Two</div>
      </div>
    
      <!-- Next and previous buttons -->
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <script>
    var slideIndex = 1;
    showSlides(slideIndex);
    
    // Next/previous controls
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }
    
    // Thumbnail image controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }
    
    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      slides[slideIndex-1].style.display = "block";
    }
    </script>
    ';
}