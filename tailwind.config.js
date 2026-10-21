import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                navy: {
                    50: '#f0f4f9',
                    100: '#dde6f2',
                    200: '#c0d1e6',
                    300: '#94b4d5',
                    400: '#6291c0',
                    500: '#3f73ab',
                    600: '#305c90',
                    700: '#274a75',
                    800: '#233f63',
                    900: '#1b2a47',
                    950: '#101d36',
                },
                accent: {
                    gold: '#f59e0b',
                    yellow: '#fbbf24',
                }
            },
        },
    },

    plugins: [forms],
};
