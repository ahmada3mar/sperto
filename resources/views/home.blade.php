@extends('layouts.app')

@section('title', 'Home')

@vite('resources/css/slider.css')

@section('content')

        <!-- Image Slider -->
        <div class="w-full h-[calc(90vh-5rem)] relative overflow-hidden slider-container ">
            <div class="slider-wrapper" id="image-slider">
                <div class="slider-item" style="background-image: url('https://placehold.co/1200x400/007bff/ffffff?text=Summer+Collection');">
                    <!-- Text content for slide 1 (optional) -->
                </div>
                <div class="slider-item" style="background-image: url('https://placehold.co/1200x400/28a745/ffffff?text=New+Arrivals');">
                    <!-- Text content for slide 2 (optional) -->
                </div>
                <div class="slider-item" style="background-image: url('https://placehold.co/1200x400/ffc107/ffffff?text=Limited+Time+Offers');">
                    <!-- Text content for slide 3 (optional) -->
                </div>
            </div>
            <!-- Hide buttons on small screens, show on medium and larger -->
            <button class="slider-nav-button left hidden md:flex" onclick="prevSlide()">&#10094;</button>
            <button class="slider-nav-button right hidden md:flex" onclick="nextSlide()">&#10095;</button>
            <div class="slider-dots" id="slider-dots">
                <!-- Dots will be generated here -->
            </div>
        </div>

<div>
    @include('partials.category_slider')
    @include('partials.new_arrivals_slider' , ['allProducts' => $allProducts])
    @include('partials.creative_category_grid')

<section class="container mx-auto px-4 py-10 mt-10 border-y border-gray-200">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <!-- Icon Box 1: Payment & Delivery -->
        <div class="flex flex-col items-center text-center p-6 bg-white rounded-lg  transition-all-ease ">
            <div class="mb-4">
                <span class="flex items-center justify-center w-16 h-16 rounded-full bg-primary-500 text-white text-3xl shadow-lg">
                    <i class="fas fa-rocket"></i> <!-- Font Awesome equivalent for icon-rocket -->
                </span>
            </div>
            <div class="elementor-icon-box-content">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Payment & Delivery
                </h3>
                <p class="text-gray-600 text-sm">
                    Free shipping for orders over $50
                </p>
            </div>
        </div>

        <!-- Icon Box 2: Return & Refund -->
        <div class="flex flex-col items-center text-center p-6 bg-white rounded-lg  transition-all-ease ">
            <div class="mb-4">
                <span class="flex items-center justify-center w-16 h-16 rounded-full bg-primary-500 text-white text-3xl shadow-lg">
                    <i class="fas fa-undo-alt"></i> <!-- Font Awesome equivalent for icon-rotate-left -->
                </span>
            </div>
            <div class="elementor-icon-box-content">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Return & Refund
                </h3>
                <p class="text-gray-600 text-sm">
                    Free 100% money back guarantee
                </p>
            </div>
        </div>

        <!-- Icon Box 3: Quality Support -->
        <div class="flex flex-col items-center text-center p-6 bg-white rounded-lg  transition-all-ease ">
            <div class="mb-4">
                <span class="flex items-center justify-center w-16 h-16 rounded-full bg-primary-500 text-white text-3xl shadow-lg">
                    <i class="fas fa-life-ring"></i> <!-- Font Awesome equivalent for icon-life-ring -->
                </span>
            </div>
            <div class="elementor-icon-box-content">
                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    Quality Support
                </h3>
                <p class="text-gray-600 text-sm">
                    Always online feedback 24/7
                </p>
            </div>
        </div>

    </div>
</section>

    @include('partials.featured_products_section' , ['featuredProducts' => $featuredProducts])
</div>

<section class="newsletter-section bg-cover bg-center py-16 md:py-24 mt-10" style="background-image: url('/assets/news-letter.png');">
    <div class="container mx-auto px-4 text-center text-white">
        <h2 class="text-4xl md:text-5xl text-white font-extrabold mb-4 leading-tight">Get The Latest Deals</h2>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">and receive $20 coupon for first shopping</p>
        <form class="flex flex-col sm:flex-row justify-center items-center max-w-md mx-auto">
            <input type="email" placeholder="Enter your Email address"
            class="w-full sm:flex-1 p-4 bg-white rounded-md sm:rounded-r-none focus:outline-none focus:ring-2 focus:ring-primary-500 text-gray-800 mb-4 sm:mb-0">
            <button type="submit" class="w-full sm:w-auto bg-primary-500 hover:bg-primary-600 text-white font-bold py-4 px-8 rounded-md sm:rounded-l-none transition-all-ease">
                SUBSCRIBE
            </button>
        </form>
    </div>
</section>

@endsection

@section('scripts')

    @vite('resources/js/slider.js')

@endsection
