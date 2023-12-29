import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
		vue(),
        laravel({
            input: [
				'resources/css/app.css',
				'resources/js/app.js',
				'resources/css/filament/backend/theme.css'
			],
            refresh: true,
        }),
		/* vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }), */
    ],
	/* resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js'
        }
    } */
});
