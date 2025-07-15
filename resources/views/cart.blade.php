@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<section id="cart-page" class="container mx-auto px-4">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Your Cart</h1>
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div id="cart-items" class="divide-y divide-gray-200">
            <!-- Cart items will be injected here by JavaScript -->
        </div>
        <div id="empty-cart-message" class="text-center text-gray-500 py-8 hidden">
            Your cart is empty. <a href="{{ route('products.index') }}" class="text-primary-500 hover:underline">Start shopping!</a>
        </div>
        <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
            <span class="text-2xl font-bold text-gray-800">Total:</span>
            <span id="cart-total" class="text-2xl font-bold text-gray-800">$0.00</span>
        </div>
        <div class="mt-8 text-right">
            <a href="{{ route('checkout') }}" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all-ease focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75">
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

    // This function is now responsible for rendering the *full* cart page content
    function renderFullCartPage() {
        cartItemsDiv.innerHTML = '';
        let total = 0;

        if (window.cart.length === 0) {
            emptyCartMessageDiv.classList.remove('hidden');
        } else {
            emptyCartMessageDiv.classList.add('hidden');
            window.cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const cartItemHtml = `
                    <div class="flex items-center py-4">
                        <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-cover rounded-lg mr-4">
                        <div class="flex-grow">
                            <h3 class="text-lg font-semibold text-gray-800">${item.name}</h3>
                            <p class="text-gray-600">$${item.price.toFixed(2)}</p>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-1 px-3 rounded-lg transition-all-ease" onclick="updateQuantity(${item.id}, -1)">-</button>
                            <span class="text-lg font-semibold">${item.quantity}</span>
                            <button class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-1 px-3 rounded-lg transition-all-ease" onclick="updateQuantity(${item.id}, 1)">+</button>
                        </div>
                        <div class="text-right ml-4">
                            <span class="text-lg font-bold text-gray-900">$${itemTotal.toFixed(2)}</span>
                            <button class="ml-4 text-red-500 hover:text-red-700 transition-all-ease" onclick="removeFromCart(${item.id})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                `;
                cartItemsDiv.innerHTML += cartItemHtml;
            });
        }
        cartTotalSpan.textContent = `$${total.toFixed(2)}`;
        updateCartCount();
    }

    document.addEventListener('DOMContentLoaded', renderFullCartPage);
</script>
@endsection
