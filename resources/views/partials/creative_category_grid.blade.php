{{-- resources/views/partials/creative_category_grid.blade.php --}}

<section class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Featured Categories</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @php
            // Dummy Category Data with specific image URLs and layout classes
            $categories = [
                [
                    'name' => 'Home Decor',
                    'product_count' => 4,
                    'image' => 'https://d-themes.com/wordpress/molla/demo-2/wp-content/uploads/sites/4/2020/11/cat-1.jpg',
                    'link' => '#', // Replace with actual category link
                    'classes' => 'md:col-span-1 md:row-span-2' // Tall item on medium and large screens
                ],
                [
                    'name' => 'Living Room',
                    'product_count' => 2,
                    'image' => 'https://d-themes.com/wordpress/molla/demo-2/wp-content/uploads/sites/4/2020/11/cat-2.jpg',
                    'link' => '#',
                    'classes' => 'md:col-span-1' // Regular item
                ],
                [
                    'name' => 'Lighting',
                    'product_count' => 3,
                    'image' => 'https://d-themes.com/wordpress/molla/demo-2/wp-content/uploads/sites/4/2020/11/cat-4.jpg',
                    'link' => '#',
                    'classes' => 'md:col-span-1 md:row-span-2' // Tall item on medium and large screens
                ],
                [
                    'name' => 'Kitchen & Utensil',
                    'product_count' => 1,
                    'image' => 'https://d-themes.com/wordpress/molla/demo-2/wp-content/uploads/sites/4/2020/11/cat-3.jpg',
                    'link' => '#',
                    'classes' => 'md:col-span-1' // Regular item
                ],
            ];
        @endphp

        @foreach ($categories as $index => $category)
            <div class="relative overflow-hidden group rounded-md shadow-md
                        {{ $category['classes'] }}

            ">
                <a href="{{ $category['link'] }}" class="block w-full h-full">
                    <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-white p-4 opacity-100 group-hover:opacity-100 transition-opacity duration-300">
                        <h3 class="text-2xl font-bold mb-2 text-center">{{ $category['name'] }}</h3>
                        <p class="text-sm text-gray-200 mb-4">{{ $category['product_count'] }} Products</p>
                        <span class="inline-flex items-center text-sm font-semibold text-white border-b-2 border-primary-500 pb-1 hover:text-primary-500 transition-colors duration-300">
                            Shop Now <i class="fas fa-arrow-right ml-2"></i>
                        </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>
