import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import auth from './vites/inputs/auth';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/usuarios/index.css',
                ...auth,

                
            ],
            refresh: true,
        }),
    ],
});
