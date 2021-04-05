jQuery(function ($) {
    $("#cart-form").submit(function(e) {
        // If input is empty and user tries to add to cart then return false
        if (counterAmountTotal === 0) {
            document.getElementById('status-submit').innerHTML = displayBootstrapAlert('danger', 'De hoeveelheid is incorrect, selecteer een positief getal.');
        } else {
            addToCart();
        }
        $('#alert-box').delay(5000).fadeOut(400);
        // Prevent page refresh
        e.preventDefault();
    });
});

function addToCart(){
    // Get data of currently active products in carousel
    let productIds = getCurrentProductIds();
    let quantity = counterAmountTotal;

    jQuery(function ($) {
        $.ajax({
            type: 'POST',
            url: `../wp-content/plugins/carousel_product/endpoints/add_to_cart.php?${formatProductsParam(productIds)}&quantity=${quantity}`,
            data: $('form').serialize(),
            success: function () {
                document.getElementById('status-submit').innerHTML = displayBootstrapAlert('success', 'Items toegevoegd aan uw winkelmandje!');
                $('#alert-box').delay(5000).fadeOut(400);
            },
            error: function(requestObject, error, errorThrown) {
                alert(error);
                alert(errorThrown);
           }
        });
    });
}

function formatProductsParam(productIds){
    let formattedProducts = '';
    productIds.forEach(productId => {
        formattedProducts += `products[]=${productId}&`;
    });
    return formattedProducts;
}

function getCurrentProductIds(){
    const slides = document.getElementsByClassName('mySlides');
    let activeProductsIds = [];

    // Convert HTMLCollection of slides elements to array and loop through, add elements that are active to array of ids
    Array.from(slides).forEach(element => {
        // Get the image of the current slide in loop, this image has the id of the product
        const image = element.querySelector('img');
        if (element.style.display == 'block'){
            activeProductsIds.push(parseInt(image.id.replace("slide-", "")));
        }
    });

    return activeProductsIds;
}