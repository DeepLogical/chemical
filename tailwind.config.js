import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './vendor/laravel/jetstream/**/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
        './resources/views/**/*.blade.php',
        './packages/deep/**/resources/views/**/**/*.blade.php',
    ],


    theme: {
        extend: {
            colors:{
                'primary': '#3B3D3C',
                'action': '#237BFF',
                'grey': '#747474',
                'lightBg': '#D6ECEE',
                'lightBack' : '#ECF2F0'
            },
            backgroundColor: {
                'primary': '#3B3D3C',
                'action': '#237BFF',
                'grey': '#747474',
                'lightBg': '#D6ECEE',
                'lightBack' : '#0000009e'

            },
            width:{
                '10': '10px',
                '12': '12px',
                '20': '20px',
                '40': '40px',
                '60': '60px',
                '100': '100px',
            },
            height:{
                '10': '10px',
                '12': '12px',
                '20': '20px',
            },
            maxWidth:{
                '20': '20px',
                '30': '30px',
                '100': '100px',
                '200': '200px',
                '250': '250px',
                '90vw': '90vw',
            },
            minWidth:{
                '150': '150px',
                '250': '250px',
            },
            maxHeight:{
                '100': '100px',
                '200': '200px',
            },
            minHeight:{
                '50': '50px',
                '200': '200px',
                '250': '250px',
                '400': '400px',
            },
            gap: {
                '20': '3rem',
            }
        },
    }
};
