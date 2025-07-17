<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <title>Sperto Store - Under Maintenance</title>

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Font Awesome (Direct CDN for maintenance page) --}}
    {{-- This assumes you're using Font Awesome. If not, remove this line. --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuRlEzO+tcaEPQogQ0KaoIF2cdGmW/JbL4w+j0F1lE7rP+Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Define your custom primary colors directly */
        :root {
            --color-primary-500: #F59E0B; /* Replace with your actual primary-500 hex code */
            --color-primary-600: #D97706; /* Replace with your actual primary-600 hex code */
            --color-primary-700: #B45309; /* A darker primary shade for hover if needed */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* bg-gray-100 */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem; /* p-4 */
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container-card {
            background-color: #ffffff; /* bg-white */
            border-radius: 0.5rem; /* rounded-lg */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
            padding: 2rem; /* p-8 */
            text-align: center;
            max-width: 32rem; /* max-w-lg */
            width: 100%;
        }

        .icon {
            color: var(--color-primary-500);
            font-size: 4rem; /* text-6xl */
            margin-bottom: 1rem; /* mb-4 */
        }

        .title {
            font-size: 2.25rem; /* text-4xl */
            font-weight: 800; /* font-extrabold */
            color: #1f2937; /* text-gray-900 */
            margin-bottom: 1rem; /* mb-4 */
            line-height: 1.25;
        }

        .description {
            color: #374151; /* text-gray-700 */
            font-size: 1.125rem; /* text-lg */
            margin-bottom: 1.5rem; /* mb-6 */
            line-height: 1.625; /* leading-relaxed */
        }

        .sub-description {
            color: #374151; /* text-gray-700 */
            font-size: 1rem; /* text-md */
            margin-bottom: 2rem; /* mb-8 */
        }

        .contact-section {
            margin-top: 2rem; /* mt-8 */
            padding-top: 1.5rem; /* pt-6 */
            border-top: 1px solid #e5e7eb; /* border-t border-gray-200 */
        }

        .contact-label {
            color: #4b5563; /* text-gray-600 */
            font-size: 0.875rem; /* text-sm */
            margin-bottom: 0.5rem; /* mb-2 */
        }

        .contact-info {
            color: #1f2937; /* text-gray-800 */
            font-weight: 600; /* font-semibold */
            margin-bottom: 0.5rem; /* mb-2 */
        }

        .contact-info:last-child {
            margin-bottom: 0;
        }

        .contact-link {
            color: var(--color-primary-500);
            text-decoration: none;
            transition: color 200ms ease-in-out;
        }

        .contact-link:hover {
            color: var(--color-primary-600);
        }

        /* Responsive padding for container-card */
        @media (min-width: 768px) { /* md:p-12 */
            .container-card {
                padding: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container-card">
        <div class="mb-6">
            {{-- Optional: Add your logo here for branding --}}
            {{-- <img src="{{ asset('assets/logo.png') }}" alt="Sperto Logo" class="h-16 mx-auto mb-4"> --}}
            <i class="fas fa-tools icon"></i> {{-- Maintenance icon --}}
        </div>

        <h1 class="title">
            We'll be back online soon!
        </h1>

        <p class="description">
            We're currently performing some important updates and maintenance to bring you an even better shopping experience.
            We appreciate your patience and apologize for any inconvenience.
        </p>

        <p class="sub-description">
            Please check back in a little while.
        </p>

        <div class="contact-section">
            <p class="contact-label">For urgent inquiries, please reach out to us:</p>
            <p class="contact-info">
                Email: <a href="mailto:sperto@spertostore.com" class="contact-link">sperto@spertostore.com</a>
            </p>
            <p class="contact-info">
                Mobile: <a href="tel:+962796583090" class="contact-link">0796583090</a>
            </p>
        </div>
    </div>
</body>
</html>
