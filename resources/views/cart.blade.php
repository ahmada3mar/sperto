@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <section id="cart-page" class="container mx-auto px-4 py-8 md:py-12">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-8 text-center">Your Cart</h1>
        <div class="bg-white rounded-lg shadow-lg p-6 md:p-8"> {{-- Added back shadow for consistency --}}
            <div id="cart-items" class="divide-y divide-gray-200">
            </div>
            <div id="empty-cart-message" class="text-center text-gray-500 py-8 hidden">
                Your cart is empty. <a href="{{ route('products.index') }}"
                    class="text-primary-500 hover:text-primary-600 font-medium transition-colors duration-200 ease-in-out">Start
                    shopping!</a>
            </div>
            <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                <span class="text-xl md:text-2xl font-bold text-gray-800">Total:</span>
                <span id="cart-total" class="text-xl md:text-2xl font-bold text-gray-800">$0.00</span>
            </div>
            <div class="mt-8 text-right">
                <a href="{{ route('checkout') }}" id="proceed-to-checkout-btn"
                    class="inline-flex items-center bg-primary-500 hover:bg-primary-700 text-white
                font-bold py-3 px-6 rounded-md shadow-lg transition-all duration-200 ease-in-out {{-- Added back shadow --}}
                focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75">
                    Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const cartItemsDiv = document.getElementById('cart-items');
        const cartTotalSpan = document.getElementById('cart-total');
        const emptyCartMessageDiv = document.getElementById('empty-cart-message');
        const proceedToCheckoutBtn = document.getElementById('proceed-to-checkout-btn');

        // This function is now responsible for rendering the *full* cart page content
        function renderFullCartPage() {
            cartItemsDiv.innerHTML = ''; // Clear previous items
            let total = 0;

            // Access the global cart from app.js directly via window.cart
            // Ensure window.cart is up-to-date from localStorage (though app.js should handle this)
            // It's safer to re-parse from localStorage if app.js might not always be instantly synced
            // If window.cart itself is directly mutated by app.js, this might not be strictly needed,
            // but it acts as a safeguard.
            let currentCart = JSON.parse(localStorage.getItem('cart')) || [];
            window.cart = currentCart; // Ensure the global window.cart reference is up-to-date

            if (!window.cart || window.cart.length === 0) {
                emptyCartMessageDiv.classList.remove('hidden');
                proceedToCheckoutBtn.classList.add('opacity-50', 'cursor-not-allowed'); // Visually disable
                proceedToCheckoutBtn.setAttribute('aria-disabled', 'true'); // For accessibility
                proceedToCheckoutBtn.style.pointerEvents = 'none'; // Disable click
            } else {
                emptyCartMessageDiv.classList.add('hidden');
                proceedToCheckoutBtn.classList.remove('opacity-50', 'cursor-not-allowed'); // Enable
                proceedToCheckoutBtn.removeAttribute('aria-disabled');
                proceedToCheckoutBtn.style.pointerEvents = 'auto'; // Enable click

                window.cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;
                    const cartItemHtml = `
                    <li class="flex flex-wrap justify-between items-center py-4 gap-4 md:gap-5 w-full">
                        <div class='flex items-center gap-3 md:gap-2'>
                            <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                            <div>
                                <h3 class="text-md text-gray-800 line-clamp-2">${item.name}</h3>
                            </div>
                        </div>

                        <div class="flex h-8 justify-between md:justify-end flex-1 items-center gap-2 text-center">
                            <p class="text-gray-600 text-sm">$${itemTotal.toFixed(2)} JOD</p>
                            <div class="flex gap-2 items-center justify-center" >
                                <div class="inline-flex h-8 items-center space-x-2 border border-gray-300 rounded-md">
                                    <button class="hover:bg-gray-100 text-gray-700 font-bold py-1 px-3 text-sm transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-l-md" onclick="window.updateQuantity(${item.id}, -1)">-</button>
                                    <span class="text-md  text-gray-900 px-2">${item.quantity}</span>
                                    <button class="hover:bg-gray-100 text-gray-700 font-bold py-1 px-3 text-sm transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-300 rounded-r-md" onclick="window.updateQuantity(${item.id}, 1)">+</button>
                                </div>
                                <div class="h-8 justify-center flex items-center border border-gray-300 rounded-md overflow-hidden">
                                    <button class="text-red-500 w-8 h-full flex items-center justify-center hover:bg-red-50 hover:text-red-700 transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50" onclick="window.removeFromCart(${item.id})">
                                        <i class="fas fa-times text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                `;
                    cartItemsDiv.innerHTML += cartItemHtml;
                });
            }
            cartTotalSpan.textContent = `$${total.toFixed(2)}`;
        }

        // Listen for the custom 'cartUpdated' event dispatched from app.js
        document.addEventListener('cartUpdated', renderFullCartPage);

        // Initial render of the full cart page when the DOM is loaded
        document.addEventListener('DOMContentLoaded', renderFullCartPage);

        // --- IMPORTANT: REMOVE ALL "DUMMY" CART FUNCTIONS FROM HERE ---
        // updateQuantity, removeFromCart, saveCart, and updateCartCount
        // are now defined and exposed globally by your app.js.
        // Having them here creates a local scope that overrides the global ones
        // for the dynamically generated HTML, causing inconsistencies.
        // DELETE the following lines (if they are still in your file):
        /*
        function updateQuantity(itemId, change) { ... }
        function removeFromCart(itemId) { ... }
        if (typeof saveCart === 'undefined') { ... }
        if (typeof updateCartCount === 'undefined') { ... }
        */

    </script>
@endsection
