import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');
    const host = env.VITE_DEV_SERVER_HOST || '0.0.0.0';
    const port = Number(env.VITE_DEV_SERVER_PORT || 5176);
    const origin = env.VITE_DEV_SERVER_ORIGIN || `http://localhost:${port}`;
    const hmrHost = env.VITE_DEV_SERVER_HMR_HOST || (host === '0.0.0.0' ? 'localhost' : host);

    return {
        server: {
            host,
            port,
            strictPort: true,
            origin,
            cors: true,
            hmr: {
                host: hmrHost,
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
    };
});