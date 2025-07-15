// resources/js/app.js

import './slider';    // Import your slider.js file

window.cart = JSON.parse(localStorage.getItem('cart')) || []; // Load cart from local storage

const cartCountSpan = document.getElementById('cart-count');
const cartAside = document.getElementById('cart-aside');
const cartOverlay = document.getElementById('cart-overlay');
const cartAsideItemsDiv = document.getElementById('cart-aside-items');
const cartAsideTotalSpan = document.getElementById('cart-aside-total');
const emptyCartAsideMessageDiv = document.getElementById('empty-cart-aside-message');


// Function to show the cart aside
window.showCartAside = function () {
    cartAside.classList.add('is-open');
    cartOverlay.classList.add('is-open');
    document.body.classList.add('no-scroll'); // Prevent body scrolling
    renderCartAside(); // Render cart items when opened
};

// Function to hide the cart aside
window.hideCartAside = function () {
    cartAside.classList.remove('is-open');
    cartOverlay.classList.remove('is-open');
    document.body.classList.remove('no-scroll'); // Re-enable body scrolling
};

// Add to cart functionality (client-side for now)
window.addToCart = function (productId, productName, productPrice, productImage) {
    const existingItem = window.cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        window.cart.push({ id: productId, name: productName, price: productPrice, image: productImage, quantity: 1 });
    }
    saveCart();
    showMessageBox(`<span class='font-bold'>${productName}</span> added to cart!`, 'success'); // Use Toastify for success
    updateCartCount();
    renderCartAside(); // Update cart aside content
    showCartAside(); // Show the cart aside after adding
};

// Remove item from cart
window.removeFromCart = function (productId) {
    cart = window.cart.filter(item => item.id !== productId);
    saveCart();
    updateCartCount();
    renderCartAside(); // Update cart aside content
    // If on the full cart page, reload it to reflect changes
    if (window.location.pathname.includes('/cart')) {
        window.location.reload();
    }
    showMessageBox('Item removed from window.cart.', 'info'); // Use Toastify for info
};

// Update quantity in cart
window.updateQuantity = function (productId, change) {
    const item = window.cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            saveCart();
            renderCartAside(); // Update cart aside content
        }
    }
    // If on the full cart page, reload it to reflect changes
    if (window.location.pathname.includes('/cart')) {
        window.location.reload();
    }
};

// Render cart items for the aside
function renderCartAside() {
    cartAsideItemsDiv.innerHTML = '';
    let total = 0;

    if (window.cart.length === 0) {
        emptyCartAsideMessageDiv.classList.remove('hidden');
    } else {
        emptyCartAsideMessageDiv.classList.add('hidden');
        window.cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            const cartItemHtml = `
                <li class="flex items-center py-4">
                    <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md mr-4">
                    <div class="flex-grow">
                        <h3 class="text-md  text-gray-800 whitespace-nowrap overflow-hidden text-ellipsis">${item.name}</h3>
                        <div class="inline-flex items-center space-x-2 border border-gray-400 ">
                            <button class=" hover:bg-gray-300 text-gray-800 font-bold py-1 px-2  text-sm transition-all-ease" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span class="text-md ">${item.quantity}</span>
                            <button class=" hover:bg-gray-300 text-gray-800 font-bold py-1 px-2  text-sm transition-all-ease" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                        <p class="text-gray-600 text-sm">${itemTotal.toFixed(2)} JOD</p>
                    </div>

                    <div class="text-center self-start">
                        <button class="text-red-500 hover:text-red-700 transition-all-ease" onclick="removeFromCart(${item.id})">
                            <i class="fas fa-times "></i>
                        </button>
                    </div>
                </li>
            `;
            cartAsideItemsDiv.innerHTML += cartItemHtml;
        });
    }
    cartAsideTotalSpan.textContent = `${total.toFixed(2)} JOD`;
}


// Update cart count in header
window.updateCartCount = function () {
    const count = window.cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cartCountSpan) {
        cartCountSpan.textContent = count;
    }
};

// Save cart to local storage
window.saveCart = function () {
    localStorage.setItem('cart', JSON.stringify(cart));
};

// Toastify Message functions
// type can be 'success', 'error', 'info', or any custom class
window.showMessageBox = function (message, type = 'info') {
    let backgroundColor = '';
    if (type === 'success') {
        backgroundColor = 'linear-gradient(to right, #28a745, #218838)'; // Green
    } else if (type === 'error') {
        backgroundColor = 'linear-gradient(to right, #dc3545, #c82333)'; // Red
    } else { // default info
        backgroundColor = 'linear-gradient(to right, #007bff, #0056b3)'; // Blue
    }

    // Create a temporary div element to parse the HTML string into a DOM node
    const messageNode = document.createElement('div');
    messageNode.innerHTML = message;

    Toastify({
        node: messageNode, // Use 'node' instead of 'text' for HTML content
        duration: 3000, // 3 seconds
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing on hover
        style: {
            background: backgroundColor,
            borderRadius: "5px",
            fontSize: "1rem",
            padding: "12px 20px"
        },
        onClick: function () { } // Callback after click
    }).showToast();
};

// hideMessageBox is no longer needed as Toastify manages its own dismissal.
window.hideMessageBox = function () {
    // Toastify messages dismiss automatically or via close button.
    // This function can be kept as a no-op if older code still calls it,
    // or simply removed if all calls are updated.
    console.log("hideMessageBox is deprecated, Toastify manages dismissal.");
};


// Initial render on page load
document.addEventListener('DOMContentLoaded', () => {
    window.updateCartCount();
    renderCartAside(); // Initial render of cart aside content on page load
});
