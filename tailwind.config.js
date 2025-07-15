// tailwind.config.js

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#f81725', // Your requested primary color
                    50: '#ffebee',
                    100: '#fecaca',
                    200: '#fca5a5',
                    300: '#f87171',
                    400: '#ef4444',
                    500: '#f81725', // Default shade (same as DEFAULT)
                    600: '#dc2626',
                    700: '#b91c1c',
                    800: '#991b1b',
                    900: '#7f1d1d',
                    950: '#450a0a',
                },
                // You can add other custom colors here as well
            },
        },
    },
    plugins: [],
};
