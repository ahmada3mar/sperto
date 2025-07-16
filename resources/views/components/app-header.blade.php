@php
    $navLinks = [
        'Home' => route('home'),
        'Products' => route('products.index'),
        'Cart' => route('cart'),
        'Checkout' => route('checkout'),
    ];
@endphp

<header class="bg-primary main shadow-sm p-4 fixed h-20 w-full z-50 top-0">
    <div class="container mx-auto flex md:flex-row-reverse flex-row justify-between items-center">
        <div class="flex gap-10">
            {{-- User Icon (Desktop) --}}
            <nav class="hidden md:flex items-center space-x-4">
                <button class="relative text-white hover:text-gray-400 transition-all-ease focus:outline-none">
                    <i class="fa-solid fa-user text-2xl"></i>
                </button>
            </nav>

            {{-- Cart Button (Desktop) --}}
            <nav class="hidden md:flex items-center space-x-4">
                {{-- REMOVED Livewire.dispatch, now uses data-open-cart-aside for JS event delegation --}}
                <button class="relative text-white hover:text-gray-400 transition-all-ease focus:outline-none" data-open-cart-aside>
                    <i class="fas fa-shopping-cart text-2xl"></i>
                    <span class="cart-count absolute -top-2 -right-2 bg-white text-primary text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                </button>
            </nav>
        </div>

        {{-- Desktop Navigation Links --}}
        <ul class="hidden md:flex">
            @foreach ($navLinks as $name => $url)
                <li class="inline-block mr-6">
                    <a href="{{ $url }}" class="text-white text-lg font-semibold hover:text-gray-400 transition-all-ease">{{ $name }}</a>
                </li>
            @endforeach
        </ul>

        {{-- Mobile Menu Toggle --}}
        <div class="md:hidden block mr-auto">
            <input type="checkbox" class="hidden" id="menu-toggle">
            {{-- The label's functionality is now handled purely by the checkbox 'change' event in app.js --}}
            {{-- No specific onclick needed here, as the checkbox state change is the trigger. --}}
            <label id="nav-icon" for="menu-toggle" class="z-50">
                <i class="transition-all text-white fa-solid fa-bars  text-2xl"></i>
            </label>
        </div>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800">
            <img src="{{ asset('assets/logo.png') }}" alt="Sperto Logo" width="100" />
        </a>
    </div>
</header>
