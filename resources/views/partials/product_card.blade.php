{{-- resources/views/partials/product_card.blade.php --}}
<div class="product-card flex flex-col justify-between relative bg-white rounded-sm shadow-sm overflow-hidden hover:shadow-md transition-all-ease">
    <div class="absolute top-2 right-2 flex flex-col items-end space-y-2 z-10">

        <span class="flex justify-center items-center uppercase
         bg-orange-600 rounded-full text-white text-xs h-10 w-10 font-semibold shadow-md">
            New
        </span>
        @if(array_key_exists('is_featured',$product) && $product['is_featured'])
        <span class="flex justify-center items-center uppercase
         bg-red-600 rounded-md text-white text-xs px-3 py-1 font-semibold shadow-md">
            Sale
        </span>
        @endif
    </div>
    <img src="{{ $product['thumb'] }}" alt="{{ $product['name'] }}"
        class="product-image h-48 w-full object-contain">

    <div class="p-5">
        {{-- Modified to truncate long names with ellipsis --}}
        <h3 class="text-md font-mono text-gray-800 mb-2">{{ Str::limit($product['name'], 25, '...') }}</h3>
        <p class="text-gray-600 text-sm mb-3 text-center">{{ number_format($product['price'], 2) }} JOD</p>
        <div class="flex  gap-2 flex-col lg:flex-row">
            <a href="{{ route('products.show', $product['product_id']) }}" class="
                text-white
                bg-primary-500
                hover:bg-primary-600
                border-gray-200
                text-sm border
                flex-1 text-center
                py-2 px-5 rounded-sm
                transition-all-ease focus:outline-none focus:ring-2
                focus:ring-opacity-75">
                Buy
            </a>
            {{-- Changed to button for JS click handler --}}
            <button onclick="window.addToCart({{ $product['product_id'] }}, '{{ $product['name'] }}', {{ $product['price'] }}, '{{ $product['thumb'] }}')" class="
                hover:bg-neutral-400
                border-gray-200
                text-sm border
                text-center
                py-2 px-5 rounded-sm
                transition-all-ease focus:outline-none focus:ring-2
                focus:ring-opacity-75">
                Add to cart
            </button>
        </div>
    </div>
</div>
