// resources/js/app.js

import './slider'; // Keep your slider.js import

// --- Global State & DOM Elements ---
// Load cart from local storage on script initialization
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Cache DOM elements for better performance and readability
const cartCountSpans = document.querySelectorAll('.cart-count');
const cartAside = document.getElementById('cart-aside');
const cartOverlay = document.getElementById('cart-overlay');
const cartAsideItemsDiv = document.getElementById('cart-aside-items');
const cartAsideTotalSpan = document.getElementById('cart-aside-total');
const emptyCartAsideMessageDiv = document.getElementById('empty-cart-aside-message');

const menuToggle = document.getElementById('menu-toggle');
const mobileMenuNav = document.getElementById('mobile-menu'); // Changed `nav` to `mobileMenuNav` for clarity
const mainContentElements = document.querySelectorAll('.main'); // Elements to slide for mobile menu

let scrollPosition = 0; // To store scroll position when overlays are open

// --- Utility Functions ---

/**
 * Saves the current cart array to local storage.
 */
function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
    // Dispatch a custom event after saving the cart
    document.dispatchEvent(new CustomEvent('cartUpdated'));
}

/**
 * Updates the displayed cart count across all relevant spans.
 */
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartCountSpans.forEach(span => span.textContent = count);
}

/**
 * Displays a Toastify notification message.
 * @param {string} message - The message content (can be HTML).
 * @param {'success' | 'error' | 'info'} type - The type of message to determine color.
 */
function showMessageBox(message, type = 'info') {
    let backgroundColor = '';
    if (type === 'success') {
        // Aligns with primary-500 and a slightly darker shade for success
        backgroundColor = 'linear-gradient(to right, #4CAF50, #4CAF50)'; // Green for success
    } else if (type === 'error') {
        // Aligns with red-500 from your theme
        backgroundColor = 'linear-gradient(to right, #EF4444, #DC2626)'; // Tailwind red-500 to red-700
    } else { // default info
        // Aligns with your primary-500 theme color for general info
        backgroundColor = 'linear-gradient(to right, #F59E0B, #D97706)'; // Tailwind amber-500 to amber-700 for info
    }

    const messageNode = document.createElement('span');
    messageNode.innerHTML = message; // Use innerHTML to parse potential HTML tags

    Toastify({
        node: messageNode,
        duration: 3000,
        close: true,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        style: {
            background: backgroundColor,
            borderRadius: "5px",
            fontSize: "1rem",
            padding: "12px 20px",
            maxWidth:'300px',
            display:'flex'
        },
        onClick: function () { }
    }).showToast();
}

/**
 * Renders the cart items in the cart aside popup.
 */
function renderCartAside() {
    cartAsideItemsDiv.innerHTML = ''; // Clear previous items
    let total = 0;

    if (cart.length === 0) {
        emptyCartAsideMessageDiv.classList.remove('hidden');
    } else {
        emptyCartAsideMessageDiv.classList.add('hidden');
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            const cartItemHtml = `
                <li class="flex p-6 justify-between  items-center py-4 gap-5 w-full">
                    <div class='flex items-center gap-2'>
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md mr-4">
                        <div class="flex flex-col gap-2">
                            <h3 class="text-md text-gray-800 text-md line-clamp-2">${item.name}</h3>
                            <div class="flex gap-1 items-center" >
                                <div class="inline-flex h-8 items-center space-x-2 border border-gray-300 rounded-md">
                                    <button class="hover:bg-gray-100 text-gray-700 font-bold py-1 px-3 text-sm transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-l-md" onclick="updateQuantity(${item.id}, -1)">-</button>
                                    <span class="text-md  text-gray-900 px-2">${item.quantity}</span>
                                    <button class="hover:bg-gray-100 text-gray-700 font-bold py-1 px-3 text-sm transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-r-md" onclick="updateQuantity(${item.id}, 1)">+</button>
                                </div>
                                <div class="h-8 justify-center flex items-center border border-gray-300 rounded-md overflow-hidden">
                                    <button class="text-red-500 w-8 h-full flex items-center justify-center hover:bg-red-50 hover:text-red-700 transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50" onclick="removeFromCart(${item.id})">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm">${itemTotal.toFixed(2)} JOD</p>
                        </div>
                    </div>
                </li>
            `;
            cartAsideItemsDiv.innerHTML += cartItemHtml;
        });
    }
    cartAsideTotalSpan.textContent = `${total.toFixed(2)} JOD`;

    // Re-attach event listeners for dynamically added buttons
    // Removed direct onclick, now using event delegation
    // attachCartItemEventListeners(); // No longer needed if using global delegation or expose functions to window.
}

/**
 * Attaches event listeners to dynamically created cart item buttons
 * (remove, update quantity). This is called after `renderCartAside()`.
 * NOTE: This function is being de-emphasized in favor of direct `onclick` calls
 * for simpler management with globally exposed functions.
 */
// function attachCartItemEventListeners() {
//     // Event delegation for quantity and remove buttons within the cart aside
//     cartAsideItemsDiv.querySelectorAll('[data-product-id]').forEach(button => {
//         button.removeEventListener('click', handleCartItemAction); // Prevent duplicate listeners
//         button.addEventListener('click', handleCartItemAction);
//     });
//     cartAsideItemsDiv.querySelectorAll('[data-remove-id]').forEach(button => {
//         button.removeEventListener('click', handleCartItemAction); // Prevent duplicate listeners
//         button.addEventListener('click', handleCartItemAction);
//     });
// }

/**
 * Handles clicks on quantity update and remove buttons in the cart aside.
 * Uses event delegation for efficiency.
 * NOTE: This function is being de-emphasized in favor of direct `onclick` calls
 * for simpler management with globally exposed functions.
 * @param {Event} event - The click event object.
 */
// function handleCartItemAction(event) {
//     const target = event.currentTarget;
//     const productId = target.dataset.productId || target.dataset.removeId;

//     if (productId) {
//         if (target.dataset.change) { // Quantity change button
//             const change = parseInt(target.dataset.change);
//             updateQuantity(parseInt(productId), change);
//         } else if (target.dataset.removeId) { // Remove button
//             removeFromCart(parseInt(productId));
//         }
//     }
// }


// --- Cart Management Functions ---

/**
 * Adds a product to the cart or increments its quantity if it already exists.
 * @param {number} productId - The ID of the product.
 * @param {string} productName - The name of the product.
 * @param {number} productPrice - The price of the product.
 * @param {string} productImage - The URL of the product image.
 */
function addToCart(productId, productName, productPrice, productImage) {
    const existingItem = cart.find(item => item.id === productId);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({ id: productId, name: productName, price: productPrice, image: productImage, quantity: 1 });
    }
    saveCart();
    showMessageBox(`<span class='font-bold'>${productName}</span> added to cart!`, 'success');
    updateCartCount();
    renderCartAside();
    // showCartAside(); // Decide if you want to show the cart automatically on add
}

/**
 * Removes an item from the cart by its product ID.
 * @param {number} productId - The ID of the product to remove.
 */
function removeFromCart(productId) {
    cart = cart.filter(item => item.id !== productId);
    saveCart();
    updateCartCount();
    renderCartAside();
    // No window.location.reload() here anymore for /cart page.
    showMessageBox('Item removed from cart.', 'info');
}

/**
 * Updates the quantity of a product in the cart.
 * @param {number} productId - The ID of the product.
 * @param {number} change - The amount to change the quantity by (e.g., 1 for increment, -1 for decrement).
 */
function updateQuantity(productId, change) {
    const item = cart.find(item => item.id === productId);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            removeFromCart(productId);
        } else {
            saveCart();
            renderCartAside();
        }
        updateCartCount();
    }
    // No window.location.reload() here anymore for /cart page.
}


// --- UI Interaction Functions (Cart Aside & Mobile Menu) ---

/**
 * Shows the cart aside panel and locks body scroll.
 */
function showCartAside() {
    cartAside.classList.add('is-open');
    cartOverlay.classList.add('is-open');

    scrollPosition = window.scrollY;
    document.body.classList.add('no-scroll-fixed');
    document.body.style.top = `-${scrollPosition}px`;

    renderCartAside(); // Ensure cart items are up-to-date
}

/**
 * Hides the cart aside panel and restores body scroll.
 */
function hideCartAside() {
    cartAside.classList.remove('is-open');
    cartOverlay.classList.remove('is-open');

    document.body.classList.remove('no-scroll-fixed');
    document.body.style.top = '';
    window.scrollTo(0, scrollPosition);
}

/**
 * Toggles the mobile menu open/closed state.
 */
function toggleMobileMenu() {
    // The checkbox state already dictates the visual toggle via CSS or the `change` listener.
    // This function primarily handles the scroll lock.
    if (menuToggle.checked) {
        // Menu is opening:
        scrollPosition = window.scrollY;
        document.body.classList.add('no-scroll-fixed');
        document.body.style.top = `-${scrollPosition}px`;
    } else {
        // Menu is closing:
        setTimeout(() => { // Delay to allow transition to finish
            document.body.classList.remove('no-scroll-fixed');
            document.body.style.top = '';
            window.scrollTo(0, scrollPosition);
        }, 300); // Match this duration with your CSS transition time
    }
}


// --- Event Listeners Initialization ---
document.addEventListener('DOMContentLoaded', () => {
    // Attach listeners to static elements
    if (menuToggle) {
        menuToggle.addEventListener('change', toggleMobileMenu);
    }

    // Event delegation for mobile menu icon and page wrapper
    // This handles the sliding of `.main` content based on checkbox state
    // and closes the menu if clicking outside.
    if (menuToggle && mobileMenuNav && mainContentElements.length > 0) {
        menuToggle.addEventListener('change', function() {
            mainContentElements.forEach(el => el.classList.toggle('translate-x-60', this.checked));
            mobileMenuNav.classList.toggle('-translate-x-[100%]', !this.checked);
        });

        // Close menu if clicking outside the menu itself when open
        document.body.addEventListener('click', (event) => {
            if (menuToggle.checked &&
                !mobileMenuNav.contains(event.target) &&
                !menuToggle.contains(event.target) && // Clicking the hidden checkbox itself
                !document.getElementById('nav-icon').contains(event.target) // Clicking the visible label
            ) {
                menuToggle.checked = false; // Uncheck to trigger 'change' and close
                mainContentElements.forEach(el => el.classList.remove('translate-x-60'));
                mobileMenuNav.classList.add('-translate-x-[100%]');
                toggleMobileMenu(); // Re-apply scroll logic for closing
            }
        });
    }


    // Cart aside buttons
    // Using event delegation on the document for efficiency, especially for "add to cart" buttons
    // that might be dynamically loaded (e.g., on product listing pages).
    document.addEventListener('click', (event) => {
        // For buttons that open the cart aside
        if (event.target.closest('[data-open-cart-aside]')) {
            showCartAside();
        }
        // For the close button within the cart aside
        if (event.target.closest('[data-close-cart-aside]')) {
            hideCartAside();
        }
        // For the overlay click
        if (event.target === cartOverlay) {
            hideCartAside();
        }
    });

    // Initial setup calls
    updateCartCount();
    renderCartAside(); // Initial render of cart aside content
});


// --- Expose functions to the global window object if absolutely necessary for Blade/inline calls ---
// It's generally better to use event listeners based on data attributes or IDs,
// but for existing inline `onclick`s, this keeps them working.
window.addToCart = addToCart;
window.removeFromCart = removeFromCart;
window.updateQuantity = updateQuantity;
window.showCartAside = showCartAside;
window.hideCartAside = hideCartAside;
window.showMessageBox = showMessageBox;
window.cart = cart; // Expose the cart for cart.blade.php to read directly

let scrollTimeout;

document.addEventListener('scroll', () => {
  document.documentElement.classList.add('scrolling');
  clearTimeout(scrollTimeout);
  scrollTimeout = setTimeout(() => {
    document.documentElement.classList.remove('scrolling');
  }, 300);
}, { passive: true, capture: true });
