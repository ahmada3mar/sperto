@extends('layouts.app')

@section('title', 'Our Products')

@section('content')
<section id="products-page" class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Our Products</h1>
    <div class="flex gap-10">
        <div class="w-1/5 hidden md:block">
            <div class="px-6 pt-2 space-y-4">
                <div class="flex justify-between items-center border-b border-gray-200 mb-10">
                    <h2 class="text-md  text-gray-800">Filters</h2>
                    <a href="#" class="text-sm text-gray-600 hover:underline">Clear All</a>
                </div>
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Categories</label>
                    <div class="flex flex-col space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600">
                            <div class="ml-2 flex items-center justify-center text-gray-700">Category 1</div>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600">
                            <div class="ml-2 flex items-center justify-center text-gray-700">Category 2</div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Brands</label>
                    <div class="flex flex-col space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600">
                            <div class="ml-2 flex items-center justify-center text-gray-700">Brand 1</div>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-primary-600">
                            <div class="ml-2 flex items-center justify-center text-gray-700">Brand 2</div>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Price range</label>
                    <input type="range" min="0" max="1000" value="500"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer" />
                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                        <span>$0</span>
                        <span>$1000</span>
                    </div>

                </div>
            </div>

        </div>

        <!-- Product List -->
        <div class="flex flex-col w-4/5">

            <div class="flex justify-between items-center text-gray-500 border-b border-gray-200 mb-10">
                <h2 class="text-sm  text-gray-600">Showing <span id="product-count-display" class="text-black">0-0 of 0</span> products</h2>
                <div class="inline-flex items-center space-x-2">
                    <div class="text-sm text-gray-600">Sort by:</div>
                    <select class="form-select block mt-1 px-2 text-sm rounded-md border-gray-300  focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        <option class="text-sm" value="default">Default</option>
                        <option class="text-sm" value="price-low-high">Price: Low to High</option>
                        <option class="text-sm" value="price-high-low">Price: High to Low</option>
                        <option class="text-sm" value="newest">Newest</option>
                    </select>
                </div>
            </div>
            <div id="product-list" class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 w-full  gap-5">
                {{-- Initial products loaded by Laravel --}}
                @foreach ($products as $product)
                    @include('partials.product_card', ['product' => $product])
                @endforeach
            </div>

            {{-- Loading Indicator --}}
            <div id="loading-indicator" class="text-center py-4 hidden">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 mx-auto"></div>
                <p class="text-gray-600 mt-2">Loading more products...</p>
            </div>

            {{-- End of products message --}}
            <div id="end-of-products" class="text-center py-4 text-gray-500 hidden">
                You've reached the end of the product list.
            </div>

        </div>

    </div>

</section>
@endsection

@section('scripts')
<script>
    const productListContainer = document.getElementById('product-list');
    const loadingIndicator = document.getElementById('loading-indicator');
    const endOfProductsMessage = document.getElementById('end-of-products');
    const productCountDisplay = document.getElementById('product-count-display');

    let currentOffset = {{ count($products) }}; // Initial offset based on products already loaded
    let productsPerPage = {{ $productsPerPage }};
    let totalProducts = {{ $totalProducts }};
    let isLoading = false;
    let hasMoreProducts = true;

    // Function to update the "Showing X-Y of Z products" text
    function updateProductCountDisplay() {
        const loadedCount = productListContainer.children.length;
        productCountDisplay.textContent = `${loadedCount} of ${totalProducts}`;
    }

    // Function to render a single product card
    function renderProductCard(product) {
        return `
            <div class="product-card relative bg-white rounded-sm shadow-sm overflow-hidden hover:shadow-md transition-all-ease">
                <div class="absolute top-2 right-2 flex flex-col items-end space-y-2 z-10">
                    ${product.is_new ? `
                    <span class="flex justify-center items-center uppercase
                     bg-primary-600 rounded-md text-white text-xs px-3 py-1 font-semibold shadow-md">
                        New
                    </span>` : ''}
                    ${product.is_featured ? `
                    <span class="flex justify-center items-center uppercase
                     bg-red-600 rounded-md text-white text-xs px-3 py-1 font-semibold shadow-md">
                        Sale
                    </span>` : ''}
                </div>
                <img src="${product.thumb}" alt="${product.name}"
                    class="product-image  h-48 w-full object-contain">

                <div class="p-5">
                    <h3 class="text-md font-mono text-gray-800 mb-2">${product.name}</h3>
                    <p class="text-gray-600 text-sm mb-3 text-center">${product.price.toFixed(2)} JOD</p>
                    <div class="flex justify-between items-center gap-2">
                        <a href="/products/${product.id}" class="
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
                        <button onclick="window.addToCart(${product.id}, '${product.name}', ${product.price}, '${product.image}')" class="
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
        `;
    }

    // Function to load more products via AJAX
    async function loadMoreProducts() {
        if (isLoading || !hasMoreProducts) {
            return;
        }

        isLoading = true;
        loadingIndicator.classList.remove('hidden');

        try {
            const response = await fetch(`/api/products-paginated?offset=${currentOffset}&limit=${productsPerPage}`);
            const data = await response.json();

            if (data.products && data.products.length > 0) {
                data.products.forEach(product => {
                    const productCardHtml = renderProductCard(product);
                    productListContainer.insertAdjacentHTML('beforeend', productCardHtml);
                });
                currentOffset = data.current_offset;
                updateProductCountDisplay();
            } else {
                hasMoreProducts = false;
                endOfProductsMessage.classList.remove('hidden');
            }

            if (currentOffset >= totalProducts) {
                hasMoreProducts = false;
                endOfProductsMessage.classList.remove('hidden');
            }

        } catch (error) {
            console.error('Error loading more products:', error);
            // Optionally show an error message to the user
        } finally {
            isLoading = false;
            loadingIndicator.classList.add('hidden');
        }
    }

    // Scroll event listener
    window.addEventListener('scroll', () => {
        // Check if user is near the bottom of the page (e.g., 500px from bottom)
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - 500)) {
            loadMoreProducts();
        }
    });

    // Initial update of product count on page load
    document.addEventListener('DOMContentLoaded', () => {
        updateProductCountDisplay();
        // If initial load has less than total products and scrollbar is not present, load more immediately
        if (currentOffset < totalProducts && document.body.offsetHeight <= window.innerHeight) {
            loadMoreProducts();
        }
    });
</script>
@endsection
