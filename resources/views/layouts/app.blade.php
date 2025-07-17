<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <title>Sperto - @yield('title', 'Home')</title>

    {{-- Consolidated CSS with Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Font Awesome is likely included via app.css if using a build tool, or can be managed directly --}}
    {{-- If you prefer CDN, uncomment this and remove any Font Awesome import from app.css/js --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- If Toastify CSS is only used on certain pages, consider moving it to a stack or component --}}
    {{-- Otherwise, import it into app.css or keep here if global and not problematic --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- Yield for head scripts/styles if needed for specific pages --}}
    @yield('head_scripts')
</head>
<body class="relative">

    {{-- Blade Component for Header --}}
    <x-app-header />

    {{-- Blade Component for Mobile Menu --}}
    <x-mobile-menu />

    {{-- Blade Component for Mobile Navigation (Bottom Bar) --}}
    <x-mobile-nav />

    <div id="page-wrapper" class="relative">
        <div class="main">
            <div class="flex flex-col h-full">
                <main class="pt-20"> {{-- Padding top to account for fixed header --}}
                    @yield('content')
                </main>

                {{-- Blade Component for Footer --}}
                <x-app-footer />
            </div>

            {{-- Blade Component for Cart Aside --}}
            <x-cart-aside />
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    @yield('scripts')
</body>
</html>
