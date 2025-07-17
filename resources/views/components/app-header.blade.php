@php
    $navLinks = [
        // Use a default if not passed, though ideally passed from header
        'Home' => [
            'url' => route('home'),
            'name' => 'home',
        ],
        'Products' => [
            'url' => route('products.index'),
            'name' => 'products.index',
        ],
        'Cart' => [
            'url' => route('cart'),
            'name' => 'cart',
        ],
        'Checkout' => [
            'url' => route('checkout'),
            'name' => 'checkout',
        ],
    ];
@endphp

{{-- Main header container --}}
{{-- Adjusted height, added padding, deeper primary color, larger shadow --}}
<header class="bg-primary-500 main shadow-lg p-5 fixed h-20 w-full z-50 top-0">
    {{-- Inner container for alignment --}}
    <div class="container mx-auto flex justify-between items-center h-full">

        {{-- Logo - Moved to the left for standard layout --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <img src="{{ asset('assets/logo.png') }}" alt="Sperto Logo" class="h-10 md:h-12 w-auto" /> {{-- Controlled image height, auto width --}}
        </a>

        {{-- Desktop Navigation Links - Centered --}}
        {{-- Flex-grow to take available space, hidden on mobile, flex on md+ --}}
        <nav class="hidden md:flex flex-grow justify-center">
            <ul class="flex space-x-8 lg:space-x-10"> {{-- Increased spacing for readability --}}
                @foreach ($navLinks as $name => $link)
                        <a href="{{ $link['url'] }}"
                           class="text-lg rounded-md py-2 px-4 font-semibold m-1
                           {{ Route::is($link['name']) ? 'bg-white text-primary-500' : 'text-white  ' }}
                           font-medium hover:text-primary-200 transition-colors duration-200 ease-in-out
                                  relative after:absolute after:bottom-0
                                  after:left-0 after:h-0.5 after:bg-white after:w-0
                                  after:hover:w-full after:transition-all after:duration-300"> {{-- Subtler hover, underline effect --}}
                            {{ $name }}
                        </a>
                @endforeach
            </ul>
        </nav>

        {{-- Right-hand Icons (User, Cart) --}}
        <div class="flex items-center space-x-6 md:space-x-8 flex-shrink-0"> {{-- Space between icons, prevents shrinking --}}
            {{-- User Icon --}}
            <button class="relative text-white hover:text-primary-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-300 rounded-full p-1"> {{-- Added padding, rounded focus ring --}}
                <i class="fa-solid fa-user text-xl md:text-2xl"></i> {{-- Slightly adjusted icon size --}}
            </button>

            {{-- Cart Button --}}
            <button class="relative text-white hover:text-primary-200 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-300 rounded-full p-1" data-open-cart-aside> {{-- Added padding, rounded focus ring --}}
                <i class="fas fa-shopping-cart text-xl md:text-2xl"></i> {{-- Slightly adjusted icon size --}}
                {{-- Cart count: Brighter background, slightly larger, bolder text --}}
                <span class="cart-count absolute -top-2 -right-2 bg-yellow-300 text-primary-800 text-xs font-extrabold rounded-full h-5 w-5 flex items-center justify-center">0</span>
            </button>

            {{-- Mobile Menu Toggle - Moved to the right for consistent mobile layout --}}
            <div class="md:hidden block"> {{-- No mr-auto, now part of right-hand group --}}
                <input type="checkbox" class="hidden" id="menu-toggle">
                <label id="nav-icon" for="menu-toggle" class="cursor-pointer"> {{-- Added cursor-pointer for better UX --}}
                    <i class="transition-all text-white fa-solid fa-bars text-2xl"></i>
                </label>
            </div>
        </div>
    </div>
</header>
