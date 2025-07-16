<div class="block md:hidden main bg-white shadow-sm pb-2 pt-4 px-6 fixed w-full z-30 bottom-0">
    <nav class="flex items-center justify-between gap-5">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-home text-xl"></i>
            Home
        </a>
        <button class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-magnifying-glass text-xl"></i>
            Search
        </button>
        <a href="{{ route('products.index') }}" class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-grip text-xl"></i>
            Shop
        </a>
            <button class="relative flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none" data-open-cart-aside>
                <i class="fas fa-shopping-cart text-xl"></i>
                <span class="cart-count absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">0</span>
                Cart
            </button>
        <button class="flex flex-col items-center text-gray-600 hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-user text-xl"></i>
            Account
        </button>
    </nav>
</div>
