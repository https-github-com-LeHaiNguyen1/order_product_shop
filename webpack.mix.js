const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        devServer: {
            historyApiFallback: {
                rewrites: [
                    { from: /.*/, to: '/index.html' },
                ],
            },
        },
    });
