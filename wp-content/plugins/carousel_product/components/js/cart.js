function addToCart(totalPrice, productIds, quantity){
    // If input is empty and user tries to add to cart then return false
    if (totalPrice == 0) {
        document.body.innerHTML += `
        <div class="alert alert-danger" role="alert">
            This is a danger alert—check it out!
        </div>`;
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        
    };
    xmlhttp.open("GET", `/endpoints/add_to_cart.php?${formatProductsParam(productIds)}&quantity=${quantity}`, true);
    xmlhttp.send();
}

function formatProductsParam(productIds){
    let formattedProducts = '';
    productIds.forEach(productId => {
        formattedProducts += `products[]=${productId}&`;
    });
    return formattedProducts;
}
