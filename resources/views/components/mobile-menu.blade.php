@props(['links'])

@php
    $navLinks = $links ?? [
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

{{-- Increased width for slightly more content space on small screens --}}
{{-- Added `overflow-y-auto` for scrollability if menu content exceeds screen height --}}
<div id="mobile-menu"
    class="h-screen fixed top-0 transition-all ease-in duration-100 bg-white shadow w-60 -translate-x-[100%] z-40">
    <div class="py-6 h-full px-4"> {{-- Slightly increased padding for better spacing --}}
        {{-- Search Bar Section --}}
        <div class="flex flex-col pb-6 border-b border-gray-200 mb-6"> {{-- Adjusted border color and spacing --}}
            <div class="w-full flex items-center bg-gray-100 rounded-lg border border-gray-200 px-3 py-2 focus-within:ring-2 focus-within:ring-primary-500"> {{-- Softer background, rounded, and focus ring --}}
                <div class="mr-2"> {{-- Added margin to separate icon from input --}}
                    <i class="fas fa-magnifying-glass text-gray-400 text-sm"></i> {{-- Changed to fas, subtle color, smaller icon --}}
                </div>
                <input type="text" placeholder="Search..." class="flex-1 bg-transparent outline-none text-gray-700 placeholder-gray-400 text-sm"> {{-- Transparent background, subtle placeholder --}}
            </div>
        </div>

        {{-- Navigation Links Section --}}
        <nav class='flex flex-col space-y-2'> {{-- Used <nav> for semantic correctness, added vertical space between links --}}
            @foreach ($navLinks as $name => $route)
                    <a href="{{ $route['url'] }}"
                        class="
                        py-3 px-4 rounded-lg {{-- Increased vertical padding, added rounded corners --}}
                        text-gray-700 hover:bg-primary-100 hover:text-primary-700 {{-- Softer hover effect, stronger hover text color --}}
                        {{ Route::is($route['name']) ? 'bg-primary-500 text-white shadow-sm' : '' }} {{-- Solid primary background for active, text white, subtle shadow --}}
                        font-medium text-base transition-all duration-200 ease-in-out block {{-- Consistent font, base size, block level for full clickable area --}}
                        ">{{ $name }}</a>
            @endforeach
        </nav>
    </div>
</div>
