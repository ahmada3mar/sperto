<div class="cart-popup widget_shopping_cart md:max-w-96 cart-canvas canvas-container" id="cart-aside">
    <div class="cart-canvas-header">
        <div class="text-md">Shopping Cart</div>
        {{-- REMOVED Livewire.dispatch, now uses data-close-cart-aside for JS event delegation --}}
        <button class="canvas-close" data-close-cart-aside><i class="fas fa-times ml-2"></i></button>
    </div>
    <div class="widget_shopping_cart_content flex flex-col justify-between">
        <div>
            {{-- Cart items will be rendered here by JavaScript --}}
            <p class="woocommerce-mini-cart__empty-message text-center text-gray-500 py-8 hidden"
                id="empty-cart-aside-message">No products in the cart.</p>

            <ul id="cart-aside-items" class="divide-y divide-gray-200 w-full">
                {{-- Cart items will be dynamically inserted here --}}
            </ul>
        </div>


    </div>
    <div class="p-5 pt-6 mt-auto" >
        <div class="flex justify-between items-center mt-2 pt-4 border-t border-gray-200">
            <span class="text-lg text-gray-800">Subtotal:</span>
            {{-- Changed $0.00 to 0.00 JOD to match the JavaScript rendering --}}
            <span id="cart-aside-total" class="text-lg text-gray-800">0.00 JOD</span>
        </div>

        <div class="pt-6">
            <a href="{{ route('cart') }}"
                class="block w-full rounded-md bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6  text-center transition-all-ease mb-4">
                View Cart
            </a>
            <a href="{{ route('checkout') }}"
                class="block w-full rounded-md bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-6  text-center transition-all-ease">
                Checkout <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</div>
{{-- REMOVED onclick from cart-overlay. The app.js `document.addEventListener('click')` will handle it by checking `event.target === cartOverlay` --}}
<div class="cart-overlay" id="cart-overlay"></div>
