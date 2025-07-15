<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <title>Sperto - @yield('title', 'Home')</title>
    @vite('resources/css/app.css')

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        /* Apply Cairo font globally. Consider moving this to resources/css/app.css for Vite processing. */
        body {
            font-size: 14px;
            font-family: 'Cairo', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

    </style>
</head>

<body>

    @php
    $links = [
    'Home' => route('home'), // Set Home to products.index for consistency
    'Products' => route('products.index'),
    'Cart' => route('cart'),
    'Checkout' => route('checkout'),
    ];
    @endphp

    <div class="flex flex-col h-full">
        <!-- Header -->
        <header class="bg-white shadow-sm py-4 px-6 fixed w-full z-50 top-0">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
                    <img src="/assets/logo.png" alt="Sperto Logo" width="100" />
                </a>
                <ul class="hidden md:flex">
                    @foreach ($links as $name => $url)
                    <li class="inline-block mr-6">
                        <a href="{{ $url }}"
                            class="text-gray-800 text-md hover:text-primary-600 transition-all-ease">{{ $name }}</a>
                    </li>
                    @endforeach
                </ul>
                <nav class="flex items-center space-x-4">
                    {{-- Updated cart button to open the cart aside --}}
                    <button class="relative text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none" onclick="showCartAside()">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <span id="cart-count"
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                    </button>
                </nav>
            </div>
        </header>

        <main class="pt-20 pb-8"> <!-- Padding top to account for fixed header -->
            <!-- Image Slider -->
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-gray-300 py-10 w-full">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 md:gap-14 gap-8">
                    {{-- About Section --}}
                    <div class="lg:col-span-2 flex flex-col">
                        <img src="/assets/logo.png" alt="Sperto Logo" class="mb-4 max-w-[104px]">
                        <p class="text-sm leading-relaxed mb-6 max-w-md">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>

                        <div class="flex flex-col sm:flex-row sm:space-x-8 items-start  space-y-4 sm:space-y-0">
                            <div>
                                <h4 class="text-white text-lg font-semibold mb-2">Got Question? Call us 24/7</h4>
                                <p class="text-primary-500 text-2xl font-normal"><a href="tel:+962796583090">+962 7 9658 3090</a></p>
                            </div>
                            <div class="flex gap-2 items-center" >
                                <h4 class="text-white text-lg font-semibold">Payment Method</h4>
                                <img class="h-5" src="/assets/visa.svg" alt="visa logo" />
                                <img class="h-5" src="/assets/master.svg" alt="master logo" />
                                <img class="h-5" src="/assets/amex.svg" alt="amex logo" />
                                <img class="h-5" src="/assets/cliq.svg" alt="cliq logo" />
                            </div>
                        </div>
                    </div>

                    {{-- Information Links --}}
                    <div>
                        <h3 class="text-white text-xl font-semibold mb-4">Information</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">About Sperto</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">How to shop on Sperto</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Contact us</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Log in</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">FAQ</a></li>
                        </ul>
                    </div>

                    {{-- Customer Service Links --}}
                    <div>
                        <h3 class="text-white text-xl font-semibold mb-4">Customer Service</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Payment Methods</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Money-back guarantee!</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Returns</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Shipping</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Terms and conditions</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Privacy Policy</a></li>
                        </ul>
                    </div>

                    {{-- My Account Links --}}
                    <div class="">
                        <h3 class="text-white text-xl font-semibold mb-4">My Account</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Sign In</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">View Cart</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">My Wishlist</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Track My Order</a></li>
                            <li><a href="#" class="hover:text-primary-500 transition-all-ease text-sm">Help</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-10 pt-6 flex flex-col md:flex-row justify-between items-center text-sm">
                    <p class="text-gray-400 mb-4 md:mb-0">Copyright © {{ date('Y') }} Sperto Store. All Rights Reserved.</p>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-400">Social Media</span>
                        <div class="flex space-x-3">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <ul class="flex space-x-4 mt-4 md:mt-0">
                        <li><a href="#" class="hover:text-primary-500 transition-all-ease text-gray-400">Terms Of Use</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-all-ease text-gray-400">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </footer>


        {{-- Toastify JS --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

        @vite('resources/js/app.js')
        @yield('scripts')
    </div>

        {{-- Cart Aside Popup --}}
    <div class="cart-popup widget_shopping_cart cart-canvas canvas-container" id="cart-aside">
        <div class="cart-canvas-header">
            <div class="text-md" >Shopping Cart</div>
            <button class="canvas-close" onclick="hideCartAside()"><i class="fas fa-times ml-2"></i></button>
        </div>
        <div class="widget_shopping_cart_content flex flex-col justify-between">
            <div>

            {{-- Cart items will be rendered here by JavaScript --}}
            <p class="woocommerce-mini-cart__empty-message text-center text-gray-500 py-8 hidden" id="empty-cart-aside-message">No products in the cart.</p>

            <ul id="cart-aside-items" class="divide-y divide-gray-200">
                {{-- Cart items will be dynamically inserted here --}}
            </ul>
            </div>

            <div>

            <div class="flex justify-between items-center mt-8 pt-4 border-t border-gray-200">
                <span class="text-xl font-bold text-gray-800">Subtotal:</span>
                <span id="cart-aside-total" class="text-xl font-bold text-gray-800">$0.00</span>
            </div>

            <div class="mt-8">
                <a href="{{ route('cart') }}" class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-md text-center transition-all-ease mb-4">
                    View Cart
                </a>
                <a href="{{ route('checkout') }}" class="block w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-6 rounded-md text-center transition-all-ease">
                    Checkout <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            </div>

        </div>
    </div>
    <div class="cart-overlay" id="cart-overlay" onclick="hideCartAside()"></div>

</body>

</html>
