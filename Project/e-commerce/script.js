
// Get cart from cookies
function getCartFromCookie() {
    const cartCookie = document.cookie.replace(/(?:(?:^|.*;\s*)cart\s*=\s*([^;]*).*$)|^.*$/, "$1");
    return cartCookie ? JSON.parse(cartCookie) : [];
}

// Set cart cookie
function setCartCookie(cart) {
    const cartJSON = JSON.stringify(cart);
    document.cookie = `cart=${cartJSON}; path=/; max-age=${365 * 24 * 60 * 60}`;
}

// Search function to filter products
function filterProducts() {
    const searchInput = document.getElementById('search-input').value.toLowerCase();
    const products = document.querySelectorAll('.product');

    products.forEach(product => {
        const productName = product.querySelector('.product-name').textContent.toLowerCase();
        if (productName.includes(searchInput)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
}

// JavaScript to handle Add to Cart functionality
function addToCart(productCode,productName, productPrice, quantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let productIndex = cart.findIndex(item => item.code === productCode);
    if (productIndex !== -1) {
        cart[productIndex].quantity += quantity;
    } else {
        cart.push({
            code: productCode,
            name: productName,
            price: productPrice,
            quantity: quantity
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();  // Update cart count after adding an item
    alert('Product added to cart!');
}


// Function to update the cart count display
function updateCartCount() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartCount = cart.reduce((total, item) => total + item.quantity, 0); // Calculate total quantity of products
    
    // Find the cart link element and update its content
    const cartLink = document.querySelector('.cart');
    if (cartLink) {
        //cartLink.textContent = `${cartCount}`; // Update the cart text with the count
        cartLink.innerHTML = `${'&nbsp;'.repeat(3)}${cartCount}`;
    }
}

 // Update cart count when the page loads
 document.addEventListener('DOMContentLoaded', function() {
    updateCartCount(); // Ensure the cart count is updated when the page loads
});



// Function to load and display the cart items
function loadCart() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let cartItems = document.getElementById('cart-items');
    let totalPrice = 0;
    cartItems.innerHTML = ''; // Clear the cart items

    cart.forEach((item, index) => {
        let amount = item.price * item.quantity;
        totalPrice += amount;

        let row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.code}</td>
            <td>${item.name}</td>
            <td>$${item.price}</td>
            <td><input type="number" value="${item.quantity}" min="1" onchange="updateQuantity(${index}, this.value)"></td>
            <td>$${amount}</td>
            <td><button onclick="removeItem(${index})">Remove</button></td>
        `;
        cartItems.appendChild(row);
    });

    document.getElementById('total-price').textContent = totalPrice.toFixed(2);
}

// Function to update the quantity of an item
function updateQuantity(index, newQuantity) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart[index].quantity = parseInt(newQuantity);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart(); // Reload the cart to reflect the changes
}

// Function to remove an item from the cart
function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1); // Remove the item at the given index
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCart(); // Reload the cart to reflect the changes
    updateCartCount(); //try
}

// Function to proceed to checkout
function proceedToCheckout() {
    // Get cart data from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Convert cart data into a JSON string and store it in a cookie
    document.cookie = "cart=" + JSON.stringify(cart) + "; path=/; max-age=" + (365 * 24 * 60 * 60);  // Set cookie for 1 year

    // Redirect to the checkout page
    window.location.href = "checkout.php";
}

// Load the cart when the page is loaded
window.onload = loadCart;