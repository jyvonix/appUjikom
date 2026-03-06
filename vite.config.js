import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: true, // Mengizinkan akses Vite melalui IP Jaringan
        hmr: {
            host: 'localhost', // Tetap gunakan localhost untuk koneksi internal
        },
    },
});
