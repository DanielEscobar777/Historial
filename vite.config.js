import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',             // Escucha en todas las interfaces de red
        port: 5176,                  // Puerto Vite (puede cambiarlo si ya está ocupado)
        hmr: {
            host: '192.168.2.132',   // ← Cambia esto por la IP de tu servidor Linux
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
