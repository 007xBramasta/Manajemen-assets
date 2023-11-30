import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// menamatkan plugin vue
import Vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        // menambahkan plugin vue
        Vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
