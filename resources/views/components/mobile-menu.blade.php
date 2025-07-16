@props(['links'])

@php
    $navLinks = $links ?? [ // Use a default if not passed, though ideally passed from header
        'Home' => route('home'),
        'Products' => route('products.index'),
        'Cart' => route('cart'),
        'Checkout' => route('checkout'),
    ];
@endphp

<div id="mobile-menu" class="h-screen fixed top-0 transition-all ease-in duration-100 bg-white shadow w-60 -translate-x-[100%] z-40">
    <div class="p-5">
        <div class="flex flex-col pb-5 border-b border-gray-300 mb-4">
            <div class="w-full flex px-1 items-center border border-gray-300">
                <div class="">
                    <i class="transition-all text-gray-300 fa-solid fa-magnifying-glass text-md"></i>
                </div>
                <input type="text" placeholder="Search ...." class="p-2 flex-1 outline-0 h-8 border-0">
            </div>
        </div>
        <ul>
            @foreach ($navLinks as $name => $url)
                <li class="mb-4">
                    <a href="{{ $url }}" class="text-gray-800 text-md hover:text-primary-600 transition-all-ease">{{ $name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
