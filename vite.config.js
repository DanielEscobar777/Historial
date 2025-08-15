import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',             
        port: 5176,                 
        hmr: {
            host: '192.168.2.132',   
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/button.css',
                'resources/css/inicio.css',
                'resources/js/app.js',
                'resources/js/buscarPaciente.js',
                'resources/js/boton.js',
            ],
            refresh: true,
        }),
    ],
});
