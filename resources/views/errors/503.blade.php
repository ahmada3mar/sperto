<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow"> {{-- Important for maintenance pages --}}

    <title>Sperto Store - Under Maintenance</title>

    {{-- Include your main compiled CSS for Tailwind --}}
    {{-- This assumes your app.css is publicly accessible even when down --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- If you're using Google Fonts, ensure this link is also here --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <style>
        /* Fallback or specific overrides if app.css doesn't fully apply */
        body {
            font-family: 'Inter', sans-serif; /* Fallback to Inter if app.css fails */
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-xl p-8 md:p-12 text-center max-w-lg w-full">
        <div class="mb-6">
            {{-- Optional: Add your logo here for branding --}}
            {{-- <img src="{{ asset('assets/logo.png') }}" alt="Sperto Logo" class="h-16 mx-auto mb-4"> --}}
            <i class="fas fa-tools text-primary-500 text-6xl mb-4"></i> {{-- Maintenance icon --}}
        </div>

        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
            We'll be back online soon!
        </h1>

        <p class="text-gray-700 text-lg mb-6 leading-relaxed">
            We're currently performing some important updates and maintenance to bring you an even better shopping experience.
            We appreciate your patience and apologize for any inconvenience.
        </p>

        <p class="text-gray-700 text-md mb-8">
            Please check back in a little while.
        </p>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-600 text-sm mb-2">For urgent inquiries, please reach out to us:</p>
            <p class="text-gray-800 font-semibold mb-2">
                Email: <a href="mailto:sperto@spertostore.com" class="text-primary-500 hover:text-primary-600 transition-colors duration-200 ease-in-out">sperto@spertostore.com</a>
            </p>
            <p class="text-gray-800 font-semibold">
                Mobile: <a href="tel:+962796583090" class="text-primary-500 hover:text-primary-600 transition-colors duration-200 ease-in-out">0796583090</a>
            </p>
        </div>
    </div>
</body>
</html>
