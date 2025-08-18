import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',  // Escucha en todas las interfaces de red
        port: 5176,       // Puerto del servidor Vite
        strictPort: true, // Asegura que use ese puerto o falle
        origin: 'http://192.168.2.132:5176', // <- Esto es CLAVE para evitar errores CORS
        cors: true,       // <- Habilita CORS en Vite
        hmr: {
            host: '192.168.2.132', // IP de tu máquina / servidor
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
