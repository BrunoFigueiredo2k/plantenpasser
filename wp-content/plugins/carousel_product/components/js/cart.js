function addToCart(productIds, quantity){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        
    };
    xmlhttp.open("GET", "/endpoints/add_to_cart.php?" + formatProductsParam(productIds) + "&quantity=" + quantity, true);
    xmlhttp.send();
}

function formatProductsParam(productIds){
    let formattedProducts = '';
    productIds.forEach(productId => {
        formattedProducts += 'products[]=' + productId + '&';
    });
    return formattedProducts;
}
