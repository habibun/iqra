/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './node_modules/tw-elements/dist/js/**/*.js',
        './assets/**/*.{vue,js,ts,jsx,tsx}',
        "./src/Shared/Presentation/Templates/**/*.twig"
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('tw-elements/dist/plugin')
    ],
}
