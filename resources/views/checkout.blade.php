@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section id="checkout-page" class="container mx-auto px-4">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Checkout</h1>
    <div class="bg-white rounded-lg shadow-lg p-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Shipping Information -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Shipping Information</h2>
            <form id="shipping-form" class="space-y-4">
                <div>
                    <label for="full-name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                    <input type="text" id="full-name" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="John Doe" required>
                </div>
                <div>
                    <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                    <input type="text" id="address" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123 Main St" required>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                        <input type="text" id="city" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Anytown" required>
                    </div>
                    <div>
                        <label for="zip" class="block text-gray-700 text-sm font-bold mb-2">Zip Code</label>
                        <input type="text" id="zip" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="12345" required>
                    </div>
                </div>
                <div>
                    <label for="country" class="block text-gray-700 text-sm font-bold mb-2">Country</label>
                    <input type="text" id="country" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="USA" required>
                </div>
            </form>
        </div>

        <!-- Order Summary & Payment -->
        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Order Summary</h2>
            <div id="checkout-summary-items" class="divide-y divide-gray-200 mb-6">
                <!-- Cart items summary will be injected here -->
            </div>
            <div class="flex justify-between items-center font-bold text-xl text-gray-800 mb-6">
                <span>Total:</span>
                <span id="checkout-total">$0.00</span>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Payment Method</h2>
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="radio" id="credit-card" name="payment-method" value="credit-card" class="form-radio text-blue-600 h-5 w-5" checked>
                    <label for="credit-card" class="ml-3 text-lg text-gray-700">Credit Card</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="paypal" name="payment-method" value="paypal" class="form-radio text-blue-600 h-5 w-5">
                    <label for="paypal" class="ml-3 text-lg text-gray-700">PayPal</label>
                </div>
                <!-- Add dummy card details input if credit card is selected -->
                <div id="credit-card-details" class="space-y-4">
                    <div>
                        <label for="card-number" class="block text-gray-700 text-sm font-bold mb-2">Card Number</label>
                        <input type="text" id="card-number" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="**** **** **** ****">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="expiry-date" class="block text-gray-700 text-sm font-bold mb-2">Expiry Date (MM/YY)</label>
                            <input type="text" id="expiry-date" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="MM/YY">
                        </div>
                        <div>
                            <label for="cvv" class="block text-gray-700 text-sm font-bold mb-2">CVV</label>
                            <input type="text" id="cvv" class="shadow appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-right">
                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all-ease focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-75" onclick="placeOrder(); return false;">
                    Place Order <i class="fas fa-check-circle ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    const checkoutSummaryItemsDiv = document.getElementById('checkout-summary-items');
    const checkoutTotalSpan = document.getElementById('checkout-total');

    // Render checkout summary
    function renderCheckoutSummary() {
        checkoutSummaryItemsDiv.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            checkoutSummaryItemsDiv.innerHTML = '<p class="text-center text-gray-500">Your cart is empty.</p>';
            document.querySelector('#checkout-page button.bg-green-600').disabled = true; // Disable place order button
        } else {
            document.querySelector('#checkout-page button.bg-green-600').disabled = false; // Enable place order button
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const summaryItemHtml = `
                    <div class="flex justify-between items-center py-3">
                        <span class="text-gray-700">${item.name} (x${item.quantity})</span>
                        <span class="font-semibold text-gray-800">$${itemTotal.toFixed(2)}</span>
                    </div>
                `;
                checkoutSummaryItemsDiv.innerHTML += summaryItemHtml;
            });
        }
        checkoutTotalSpan.textContent = `$${total.toFixed(2)}`;
    }

    // Place order (dummy function)
    function placeOrder() {
        if (cart.length === 0) {
            showMessageBox('Your cart is empty. Please add items before placing an order.');
            return;
        }

        const fullName = document.getElementById('full-name').value;
        const address = document.getElementById('address').value;
        const city = document.getElementById('city').value;
        const zip = document.getElementById('zip').value;
        const country = document.getElementById('country').value;

        if (!fullName || !address || !city || !zip || !country) {
            showMessageBox('Please fill in all shipping information fields.');
            return;
        }

        // Simulate order processing
        showMessageBox('Order placed successfully! Thank you for your purchase.');
        cart = []; // Clear cart after order
        saveCart();
        updateCartCount();
        // Redirect to products page after a delay
        setTimeout(() => window.location.href = '{{ route('products.index') }}', 2000);
    }

    document.addEventListener('DOMContentLoaded', renderCheckoutSummary);
</script>
@endsection
