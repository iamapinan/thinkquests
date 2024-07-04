import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/quiz-builder.js',
                'resources/js/quiz.js',
                'resources/js/score.js',
                'resources/js/upload.js',
                'resources/js/permission.js',
                'resources/js/user-management.js',

            ],
            refresh: true,
        }),
    ],
});
