import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import preset from './vendor/filament/support/tailwind.config.preset'

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './resources/views/vendor/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: {
                    50: '#FFEAEA',
                    100: '#FFD5D5',
                    200: '#FFABAB',
                    300: '#FF8282',
                    400: '#FF5858',
                    500: '#FF2E2E',
                    600: '#D42828',
                    700: '#AA2222',
                    800: '#801B1B',
                    900: '#551515',
                },
                gray: {
                    750: '#242C38',
                },
                amber: {
                    950: '#451a03',
                }
            },
        },
    },
    plugins: [forms],
};
