<footer class="bg-gray-800 text-gray-300 py-10 w-full">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 md:gap-14 gap-8">
            {{-- About Section --}}
            <div class="lg:col-span-2 flex flex-col">
                <img src="{{ asset('assets/logo.png') }}" alt="Sperto Logo" class="mb-4 max-w-[104px]">
                <p class="text-sm leading-relaxed mb-6 max-w-md">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>

                <div class="flex flex-col sm:flex-row sm:space-x-8 items-start space-y-4 sm:space-y-0">
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-2">Got Question? Call us 24/7</h4>
                        <p class="text-primary-500 text-2xl font-normal"><a href="tel:+962796583090">+962 7 9658 3090</a></p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <h4 class="text-white text-lg font-semibold">Payment Method</h4>
                        <img class="h-5" src="{{ asset('assets/visa.svg') }}" alt="visa logo" />
                        <img class="h-5" src="{{ asset('assets/master.svg') }}" alt="master logo" />
                        <img class="h-5" src="{{ asset('assets/amex.svg') }}" alt="amex logo" />
                        <img class="h-5" src="{{ asset('assets/cliq.svg') }}" alt="cliq logo" />
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
