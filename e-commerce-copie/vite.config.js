import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    // server: {
    //     host: true, // Très important : permet à Vite d'être accessible via l'IP du réseau
    //     // port: 5173, // Port par défaut de Vite, vous pouvez le spécifier si besoin
    //     hmr: {
    //         host: '192.168.0.104' // Essentiel pour le Hot Module Replacement sur le réseau
    //     }
    // }
});
