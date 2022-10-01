/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './node_modules/tw-elements/dist/js/**/*.js',
        './assets/**/*.{vue,js,ts,jsx,tsx}',
        "./src/Shared/Presentation/Template/**/*.twig",
        "./src/Quran/Presentation/Template/**/*.twig",
        "./src/Context/Presentation/Template/**/*.twig",
        "./src/Sign/Presentation/Template/**/*.twig",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('tw-elements/dist/plugin')
    ],
}
