import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/* @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        // "./app/Forms/*.php",
        // "./app/Tables/*.php",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                "50": "#ffeef0",
                "100": "#ffd6d9",
                "200": "#ffb3b3",
                "300": "#ff8a8a",
                "400": "#ff5c5c",
                "500": "#ff3333",
                "600": "#e60000",
                "700": "#cc0000",
                "800": "#b20000",
                "900": "#990000",
                "950": "#800000"
            }
            }
        },
    },

    plugins: [
        forms,
        typography,
        require('flowbite/plugin'),
    ],
    darkMode: 'class',
};
