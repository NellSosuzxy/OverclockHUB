import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// You can remove tailwind if you are using Bootstrap as per the guide

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',  // <--- CHANGED FROM css/app.css
                'resources/js/app.js'
            ],
            refresh: true,
        }),
    ],
});