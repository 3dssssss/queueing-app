import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    safelist: [
        'bg-pink-800', 'bg-pink-500', 'hover:bg-pink-700', 'focus:bg-pink-500', 'active:bg-pink-900'

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backdropBlur: {
                sm: '4px',
                md: '8px',
                lg: '12px',
            },
        },
    },

    plugins: [forms],
};


