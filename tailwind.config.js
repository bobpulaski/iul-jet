import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

// @type {import('tailwindcss').Config}

export default {
    darkMode: "selector",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    watch: {
        reloadOnBladeUpdates: true,
    },
    theme: {
        extend: {
            // fontFamily: {
            //     sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            // },
        },
    },
    plugins: [forms, typography],
};
