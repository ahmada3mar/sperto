@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <section id="checkout-page" class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="bg-white p-6 md:p-8">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 border-b pb-4">Shipping Information</h2>
                <form id="shipping-form" class="space-y-6">
                    <div class="grid grid-cols-2  gap-4">
                        <div class="flex flex-1">
                            <input class="hidden peer" type="radio" name="delivery_method" id="delivery" checked>
                            <label for="delivery"
                                class="flex flex-1 cursor-pointer relative justify-center items-center flex-col p-2 md:p-4 rounded-md border border-gray-200
                                peer-checked:border-primary-500 delivery peer-checked:bg-primary-50 gap-1 md:gap-2
                                hover:bg-gray-50 hover:border-primary-200 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-truck-moving text-md md:text-xl text-gray-700 peer-checked:text-primary-600"></i>
                                <p class="text-gray-700 text-sm md:text-md peer-checked:text-primary-600">Delivery</p>
                            </label>
                        </div>
                        <div class="flex flex-1">
                            <input class="hidden peer" type="radio" name="delivery_method" id="pickup">
                            <label for="pickup"
                                class="flex flex-1 cursor-pointer relative justify-center items-center flex-col p-2 md:p-4 rounded-md border border-gray-200
                                peer-checked:border-primary-500 delivery peer-checked:bg-primary-50 gap-1 md:gap-2
                                hover:bg-gray-50 hover:border-primary-200 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-cube text-md md:text-xl text-gray-700 peer-checked:text-primary-600"></i>
                                <p class="text-gray-700 text-sm md:text-md peer-checked:text-primary-600">Pickup</p>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="full-name" class="block text-gray-700 text-sm font-bold mb-2">Full Name</label>
                        <input type="text" id="full-name"
                            class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                            placeholder="Ahmad E'mar" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-Mail</label>
                        <input type="email" id="email"
                            class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                            placeholder="someone@example.com" required>
                    </div>
                    <div>
                        <label for="mobile" class="block text-gray-700 text-sm font-bold mb-2">Mobile</label>
                        <input type="tel" id="mobile"
                            class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                            placeholder="07XXXXXXXX" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="city" class="block text-gray-700 text-sm font-bold mb-2">City</label>
                            <select id="city"
                                class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                                required>
                                <option value="">Select City</option>
                                <option>Amman</option>
                                <option>Az Zarqaa'</option>
                                <option>Irbid</option>
                            </select>
                        </div>
                        <div>
                            <label for="area" class="block text-gray-700 text-sm font-bold mb-2">Area</label>
                            <select id="area"
                                class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                                required>
                                <option value="">Select Area</option>
                                <option>Al Jabdaweel</option>
                                <option>Al Hashmi</option>
                                <option>Khalda</option>
                            </select>
                        </div>
                        <div>
                            <label for="building" class="block text-gray-700 text-sm font-bold mb-2">Building</label>
                            <input type="text" id="building"
                                class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                                placeholder="Building" required>
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                        <input type="text" id="address"
                            class="appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 ease-in-out"
                            placeholder="Street Name, Apt/Suite, etc." required>
                    </div>
                </form>
            </div>

            <div class="flex flex-col bg-gray-50 p-6 md:p-8">
                <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 border-b pb-4">Order Summary</h2>
                <div id="checkout-summary-items" class="divide-y divide-gray-200 flex-grow">
                    </div>
                <button id="show-all-items-btn"
                    class="w-full text-center text-primary-600 font-medium py-2 rounded-md hover:bg-gray-100 transition-colors duration-200 hidden">
                    Show All Items <i class="fas fa-chevron-down ml-1 text-sm"></i>
                </button>
                <div id="accordion-items" class="divide-y divide-gray-200 mb-6 hidden max-h-96 overflow-y-auto custom-scrollbar pr-2">
                    </div>

                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center text-md text-gray-800">
                        <span>Subtotal:</span>
                        <span id="checkout-sub-total">$0.00</span>
                    </div>
                    <div class="flex justify-between items-center text-md text-gray-800">
                        <span>Delivery fees:</span>
                        <span id="checkout-delivery-fees">$0.00</span>
                    </div>
                </div>
                <div class="flex justify-between border-t border-gray-200 pt-5 items-center font-semibold text-lg md:text-xl text-gray-800 mb-8">
                    <span>Total:</span>
                    <span id="checkout-total">$0.00</span>
                </div>

                <div class="mt-auto">
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-6 border-b pb-4">Payment Method</h2>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="flex flex-1">
                            <input class="hidden peer" type="radio" name="payment_method" id="credit-card" checked>
                            <label for="credit-card"
                                class="flex flex-1 cursor-pointer relative justify-center items-center flex-col p-2 md:p-4 rounded-md border border-gray-200
                                peer-checked:border-primary-500 delivery peer-checked:bg-primary-50 gap-1 md:gap-2
                                hover:bg-gray-50 hover:border-primary-200 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-credit-card text-md md:text-xl text-gray-700 peer-checked:text-primary-600"></i>
                                <p class="text-gray-700 text-sm md:text-md peer-checked:text-primary-600">Credit Card</p>
                            </label>
                        </div>
                        <div class="flex flex-1">
                            <input class="hidden peer" type="radio" name="payment_method" id="CliQ">
                            <label for="CliQ"
                                class="flex flex-1 cursor-pointer relative justify-center items-center flex-col p-2 md:p-4 rounded-md border border-gray-200
                                peer-checked:border-primary-500 delivery peer-checked:bg-primary-50 gap-1 md:gap-2
                                hover:bg-gray-50 hover:border-primary-200 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-comments-dollar text-md md:text-xl text-gray-700 peer-checked:text-primary-600"></i>
                                <p class="text-gray-700 text-sm md:text-md peer-checked:text-primary-600">CliQ</p>
                            </label>
                        </div>
                        <div class="flex flex-1">
                            <input class="hidden peer" type="radio" name="payment_method" id="Cash">
                            <label for="Cash"
                                class="flex flex-1 cursor-pointer relative justify-center items-center flex-col p-2 md:p-4 rounded-md border border-gray-200
                                peer-checked:border-primary-500 delivery peer-checked:bg-primary-50 gap-1 md:gap-2
                                hover:bg-gray-50 hover:border-primary-200 transition-all duration-200 ease-in-out">
                                <i class="fa-solid fa-money-bill-wave text-md md:text-xl text-gray-700 peer-checked:text-primary-600"></i>
                                <p class="text-gray-700 text-sm md:text-md peer-checked:text-primary-600">Cash</p>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 text-right">
                        <button type="submit"
                            class="bg-primary-500 hover:bg-primary-700 text-white
                            font-bold py-3 px-8 rounded-md shadow-lg transition-all duration-200 ease-in-out
                            focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75"
                            onclick="placeOrder(); return false;">
                            Place Order <i class="fas fa-check-circle ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const checkoutSummaryItemsDiv = document.getElementById('checkout-summary-items');
        const accordionItemsDiv = document.getElementById('accordion-items');
        const showAllItemsBtn = document.getElementById('show-all-items-btn');
        const checkoutSubTotalSpan = document.getElementById('checkout-sub-total');
        const checkoutDeliveryFees = document.getElementById('checkout-delivery-fees');
        const checkoutTotalSpan = document.getElementById('checkout-total');
        const placeOrderButton = document.querySelector('#checkout-page button[type="submit"]');

        // Initial check for cart content to enable/disable button
        document.addEventListener('DOMContentLoaded', () => {
            renderCheckoutSummary();
            // Attach form submission to the button's click event or form submit
            document.getElementById('shipping-form').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission
                placeOrder();
            });

            showAllItemsBtn.addEventListener('click', () => {
                accordionItemsDiv.classList.toggle('hidden');
                const icon = showAllItemsBtn.querySelector('i');
                if (accordionItemsDiv.classList.contains('hidden')) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                    showAllItemsBtn.innerHTML = 'Show All Items <i class="fas fa-chevron-down ml-1 text-sm"></i>';
                } else {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                    showAllItemsBtn.innerHTML = 'Hide Items <i class="fas fa-chevron-up ml-1 text-sm"></i>';
                }
            });
        });

        // Render checkout summary
        function renderCheckoutSummary() {
            checkoutSummaryItemsDiv.innerHTML = '';
            accordionItemsDiv.innerHTML = ''; // Clear accordion items as well
            showAllItemsBtn.classList.add('hidden'); // Hide button by default
            accordionItemsDiv.classList.add('hidden'); // Ensure accordion is hidden initially

            let subTotal = 0;
            const deliveryFee = 2; // Fixed delivery fee

            if (!window.cart || window.cart.length === 0) {
                checkoutSummaryItemsDiv.innerHTML = '<p class="text-center text-gray-500 py-4">Your cart is empty.</p>';
                placeOrderButton.disabled = true;
                placeOrderButton.classList.add('opacity-50', 'cursor-not-allowed'); // Visually indicate disabled
            } else {
                placeOrderButton.disabled = false;
                placeOrderButton.classList.remove('opacity-50', 'cursor-not-allowed'); // Remove disabled styles

                // Display the first item
                const firstItem = window.cart[0];
                const firstItemTotal = firstItem.price * firstItem.quantity;
                subTotal += firstItemTotal;
                const firstItemHtml = `
                    <div class="flex justify-between items-center py-3">
                        <div class="flex gap-3 items-center">
                            <img src="${firstItem.image}" alt="${firstItem.name}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                            <span class="text-gray-700 font-medium">${firstItem.name} <span class="text-gray-500">(x${firstItem.quantity})</span></span>
                        </div>
                        <span class="font-semibold text-gray-800">$${firstItemTotal.toFixed(2)}</span>
                    </div>
                `;
                checkoutSummaryItemsDiv.innerHTML += firstItemHtml;

                // If there are more items, create accordion for them
                if (window.cart.length > 1) {
                    showAllItemsBtn.classList.remove('hidden'); // Show the "Show All Items" button

                    for (let i = 1; i < window.cart.length; i++) {
                        const item = window.cart[i];
                        const itemTotal = item.price * item.quantity;
                        subTotal += itemTotal; // Still add to total, even if in accordion

                        const accordionItemHtml = `
                            <div class="flex justify-between items-center py-3">
                                <div class="flex gap-3 items-center">
                                    <img src="${item.image}" alt="${item.name}" class="w-16 h-16 object-cover rounded-md flex-shrink-0">
                                    <span class="text-gray-700 font-medium">${item.name} <span class="text-gray-500">(x${item.quantity})</span></span>
                                </div>
                                <span class="font-semibold text-gray-800">$${itemTotal.toFixed(2)}</span>
                            </div>
                        `;
                        accordionItemsDiv.innerHTML += accordionItemHtml;
                    }
                } else {
                    // If only one item, hide the accordion related elements
                    showAllItemsBtn.classList.add('hidden');
                    accordionItemsDiv.classList.add('hidden');
                }
            }
            checkoutSubTotalSpan.textContent = `$${subTotal.toFixed(2)}`;
            checkoutDeliveryFees.textContent = `$${deliveryFee.toFixed(2)}`;
            checkoutTotalSpan.textContent = `$${(subTotal + deliveryFee).toFixed(2)}`;
        }

        // Place order (dummy function)
        function placeOrder() {
            if (!window.cart || window.cart.length === 0) {
                showMessageBox('Your cart is empty. Please add items before placing an order.', 'error');
                return;
            }

            const fullName = document.getElementById('full-name').value;
            const email = document.getElementById('email').value;
            const mobile = document.getElementById('mobile').value;
            const city = document.getElementById('city').value;
            const area = document.getElementById('area').value;
            const building = document.getElementById('building').value;
            const address = document.getElementById('address').value;
            const deliveryMethod = document.querySelector('input[name="delivery_method"]:checked').id;
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked').id;


            // Basic validation (can be more robust with regex for email/mobile)
            if (!fullName || !email || !mobile || !city || !area || !building || !address) {
                showMessageBox('Please fill in all shipping information fields.', 'error');
                return;
            }

            // Simulate order processing
            showMessageBox('Order placed successfully! Thank you for your purchase.', 'success');

            // In a real application, you'd send this data to your backend:
            const orderData = {
                fullName,
                email,
                mobile,
                city,
                area,
                building,
                address,
                deliveryMethod,
                paymentMethod,
                items: window.cart,
                subTotal: parseFloat(checkoutSubTotalSpan.textContent.replace('$', '')),
                deliveryFees: parseFloat(checkoutDeliveryFees.textContent.replace('$', '')),
                total: parseFloat(checkoutTotalSpan.textContent.replace('$', ''))
            };
            console.log("Order Data:", orderData); // For debugging

            window.cart = []; // Clear cart after successful order
            saveCart(); // Save the empty cart to local storage
            updateCartCount(); // Update the cart count displayed in the header/nav

            // Redirect to products page after a delay
            setTimeout(() => window.location.href = '{{ route('products.index') }}', 2000);
        }

        // Dummy showMessageBox function (replace with your actual implementation)
        function showMessageBox(message, type = 'info') {
            // This is a placeholder. You'd typically use a proper notification library (e.g., SweetAlert2, Toastr)
            // or a custom-designed notification element.
            alert(message);
        }
    </script>

@endsection
