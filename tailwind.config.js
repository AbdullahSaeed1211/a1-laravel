/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './app/Livewire/**/*.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                accent: {
                    DEFAULT: '#c9a96e',
                    light: '#d4b87a',
                },
                asphaltBlack: '#111111',
                lightGray: '#F3F4F6',
            },
            fontFamily: {
                heading: ['Barlow Condensed', 'sans-serif'],
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
};
