module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },
}
