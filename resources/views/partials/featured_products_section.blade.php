{{-- resources/views/partials/featured_products_section.blade.php --}}

<section class="container mx-auto px-4 py-8 mt-10">
    <div class="flex flex-col items-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Featured Products</h2>

        {{-- Category Filter Tabs (Removed as per request) --}}
    </div>

    {{-- Featured Products Grid --}}
    <div id="featured-products-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        {{-- Products will be rendered here by JavaScript --}}
    </div>

    {{-- Loading Indicator --}}
    <div id="featured-loading-indicator" class="text-center py-4 hidden">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 mx-auto"></div>
        <p class="text-gray-600 mt-2">Loading featured products...</p>
    </div>

    {{-- Load More Button --}}
    <div class="text-center mt-8">
        <button id="load-more-featured-btn" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-3 px-6 rounded-md shadow-md transition-all-ease focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-opacity-75">
            Load More Products <i class="fas fa-arrow-down ml-2"></i>
        </button>
        <p id="no-more-featured-products" class="text-gray-500 mt-4 hidden">No more featured products to load.</p>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Removed filterLinks as they are no longer needed
        const featuredProductsGrid = document.getElementById('featured-products-grid');
        const loadMoreBtn = document.getElementById('load-more-featured-btn');
        const noMoreProductsMsg = document.getElementById('no-more-featured-products');
        const featuredLoadingIndicator = document.getElementById('featured-loading-indicator');

        let featuredCurrentFilter = 'all'; // Keep 'all' as default, but no UI to change it
        let featuredCurrentOffset = 0;
        const featuredProductsPerPage = 8; // Number of products to fetch per API call
        let featuredTotalProducts = 0; // Will be updated by API response
        let featuredIsLoading = false;
        let featuredHasMoreProducts = true;

        // Function to render a single product card (reused from product_card partial logic)
       function renderFeaturedProductCard(product) {
            // Helper for string truncation
            const truncateString = (str, num) => {
                if (str.length <= num) {
                    return str;
                }
                return str.slice(0, num) + '...';
            };

            return `
                <div class="product-card flex flex-col justify-between relative bg-white rounded-sm shadow-sm overflow-hidden hover:shadow-md transition-all-ease">
                    <div class="absolute top-2 right-2 flex flex-col items-end space-y-2 z-10">
                        ${product.is_new ? `
                        <span class="flex justify-center items-center uppercase
                         bg-orange-600 rounded-full text-white text-xs h-10 w-10 font-semibold shadow-md">
                            New
                        </span>` : ''}
                        ${product.is_featured ? `
                        <span class="flex justify-center items-center uppercase
                         bg-red-600 rounded-md text-white text-xs px-3 py-1 font-semibold shadow-md">
                            Sale
                        </span>` : ''}
                    </div>
                    <img src="${product.thumb}" alt="${product.name}"
                        class="product-image h-48 w-full object-contain">

                    <div class="p-5">
                        <h3 class="text-md font-mono text-gray-800 mb-2">${truncateString(product.name, 25)}</h3>
                        <p class="text-gray-600 text-sm mb-3 text-center">${product.price.toFixed(2)} JOD</p>
                        <div class="flex gap-2 flex-col lg:flex-row">
                            <a href="/products/${product.product_id}" class="
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
                            <button onclick="window.addToCart(${product.product_id}, '${product.name}', ${product.price}, '${product.thumb}')" class="
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


        // Function to fetch and display featured products
        async function fetchAndDisplayFeaturedProducts(reset = false) {
            if (featuredIsLoading || (!featuredHasMoreProducts && !reset)) {
                return;
            }

            featuredIsLoading = true;
            featuredLoadingIndicator.classList.remove('hidden');
            loadMoreBtn.classList.add('hidden'); // Hide button while loading
            noMoreProductsMsg.classList.add('hidden'); // Hide "no more" message while loading

            if (reset) {
                featuredProductsGrid.innerHTML = ''; // Clear existing products if resetting
                featuredCurrentOffset = 0;
                featuredHasMoreProducts = true;
            }

            try {
                // The API call no longer needs the category filter parameter since the tabs are removed.
                // It will always fetch 'all' featured products as per the backend logic.
                let apiUrl = `/api/products-paginated?offset=${featuredCurrentOffset}&limit=${featuredProductsPerPage}`;

                const response = await fetch(apiUrl);
                const data = await response.json();

                if (data.products && data.products.length > 0) {
                    data.products.forEach(product => {
                        featuredProductsGrid.insertAdjacentHTML('beforeend', renderFeaturedProductCard(product));
                    });
                    featuredCurrentOffset = data.current_offset;
                    featuredTotalProducts = data.total_products; // Update total products from API
                } else {
                    featuredHasMoreProducts = false;
                }

                // Check if there are more products to load
                if (featuredCurrentOffset >= featuredTotalProducts) {
                    featuredHasMoreProducts = false;
                }

            } catch (error) {
                console.error('Error loading featured products:', error);
                // Optionally show an error message to the user using Toastify
                window.showMessageBox('Failed to load featured products. Please try again.', 'error');
            } finally {
                featuredIsLoading = false;
                featuredLoadingIndicator.classList.add('hidden');

                // Update button visibility after loading
                if (featuredHasMoreProducts) {
                    loadMoreBtn.classList.remove('hidden');
                } else {
                    noMoreProductsMsg.classList.remove('hidden');
                }
            }
        }

        // Removed Event Listeners for filter tabs

        // Event listener for Load More button
        loadMoreBtn.addEventListener('click', () => fetchAndDisplayFeaturedProducts(false));

        // Initial load of featured products when the DOM is ready
        fetchAndDisplayFeaturedProducts(true); // Load initial products (all, as filter is removed)
    });
</script>
