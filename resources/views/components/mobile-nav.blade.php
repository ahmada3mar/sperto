<div class="block md:hidden main bg-white shadow-sm pb-2 pt-4 px-2 fixed w-full z-30 bottom-0">
    <nav class="grid grid-cols-5 gap-2 items-center justify-between ">
        <a href="{{ route('home') }}"
            class="flex p-2 rounded-md
        {{ Route::is('home') ? 'bg-primary text-white' : 'text-gray-600' }}
        flex-col items-center hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-home text-xl"></i>
            Home
        </a>
        <button
            class="flex flex-col items-center p-2
        text-gray-600
         hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-magnifying-glass text-xl"></i>
            Search
        </button>
        <a href="{{ route('products.index') }}"
            class="flex flex-col p-2 items-center rounded-md
        {{ Route::is('products.index') ? 'bg-primary text-white' : 'text-gray-600' }}
         hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-grip text-xl"></i>
            Shop
        </a>
        <button
            class="relative flex flex-col items-center p-2 rounded-md
            {{ Route::is('cart') ? 'bg-primary text-white' : 'text-gray-600' }}
             hover:text-gray-900 transition-all-ease focus:outline-none"
            data-open-cart-aside>
            <i class="fas fa-shopping-cart text-xl relative">
                <span
                    class="cart-count absolute -top-3 -right-3 p-1  bg-red-500 text-white text-[8px]
                    rounded-full h-5 w-5 flex items-center justify-center">
                    0
                </span>
            </i>

            Cart
        </button>
        <button
            class="flex flex-col items-center p-2 rounded-md
        {{ Route::is('account') ? 'bg-primary text-white' : 'text-gray-600' }}
         hover:text-gray-900 transition-all-ease focus:outline-none">
            <i class="fas fa-user text-xl"></i>
            Account
        </button>
    </nav>
</div>
