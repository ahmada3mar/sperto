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

<div id="mobile-menu"
    class="h-screen fixed top-0 transition-all ease-in duration-100 bg-white shadow w-60 -translate-x-[100%] z-40">
    <div class="p-5">
        <div class="flex flex-col pb-5 border-b border-gray-300 mb-4">
            <div class="w-full flex px-1 items-center bg-white rounded-md border border-gray-300">
                <div class="">
                    <i class="transition-all text-gray-300 fa-solid fa-magnifying-glass text-md"></i>
                </div>
                <input type="text" placeholder="Search ...." class="p-2 flex-1 outline-0 h-8 border-0">
            </div>
        </div>
        <div class='flex flex-col'>
            @foreach ($navLinks as $name => $route)
                    <a href="{{ $route['url'] }}"
                        class="
                        py-2 px-4
                        {{ Route::is($route['name']) ? 'text-white bg-primary' : 'text-gray-600 hover:bg-primary-50' }}
                        text-lg  transition-all-ease">{{ $name }}</a>
            @endforeach
        </div>
    </div>
</div>
