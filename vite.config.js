import { defineConfig } from 'vite';
import vue              from '@vitejs/plugin-vue';
import path             from 'path';

export default defineConfig({
    base: '',

    publicDir: false,

    build: {
        manifest: true,
        outDir: 'public/dist',
        rollupOptions: {
            input: 'resources/js/app.ts',
        },
    },

    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 3001,
    },

    resolve: {
        alias: {
            '@': path.resolve('./resources/js'),
            'ziggy': path.resolve('./vendor/tightenco/ziggy/src/js'),
        },
    },


    optimizeDeps: {
        include: [
            'vue',
            '@inertiajs/inertia',
            '@inertiajs/inertia-vue3',
            '@inertiajs/progress',
            'axios',
        ],
    },

    plugins: [vue()],
});