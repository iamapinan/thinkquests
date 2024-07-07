import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

// Function to get all JavaScript files in the resources/js directory
const getJsFiles = (dir, files = []) => {
    fs.readdirSync(dir).forEach(file => {
        const filePath = path.join(dir, file);
        if (fs.statSync(filePath).isDirectory()) {
            getJsFiles(filePath, files);
        } else if (filePath.endsWith('.js')) {
            files.push(filePath);
        }
    });
    return files;
};

const jsFiles = getJsFiles(path.resolve(__dirname, 'resources/js'));

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                ...jsFiles
            ],
            refresh: true,
        }),
    ],
});