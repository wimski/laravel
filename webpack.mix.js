const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .extract([
        'axios',
        'lodash',
        'jquery',
        'popper.js',
        'bootstrap',
    ])
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/img', 'public/img');

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps(false)
        .webpackConfig({devtool: 'source-map'});
}
