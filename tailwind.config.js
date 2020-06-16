module.exports = {

    theme: {
        extend: {
            screens: {
                'xl': '1160px',
            },
            fontSize: {
                'base': '1.0625rem',
            },
            colors: {
                'primary': '#243c5a',
                'primary-dark': '#17173e',
                'light': '#f4f4f4',
                'secondary': '#999999',
                'secondary-dark': '#666666',
            },
            height: {
                '75': '25rem'
            },
            width: {
                '75': '25rem',
                '300': '300px'
            },

            aspectRatio: { // defaults to {}
                'none': 0,
                'square': [1, 1], // or 1 / 1, or simply 1
                '16/9': [16, 9],  // or 16 / 9
                '4/3': [4, 3],    // or 4 / 3
                '21/9': [21, 9],  // or 21 / 9
            },
        }
    },

    variants: {
        aspectRatio: ['responsive'], // defaults to ['responsive']
    },
    plugins: [
        require("tailwindcss-responsive-embed"),
        require('tailwindcss-aspect-ratio'),
    ],

    purge: {
        content: [
            './templates/**/*.html',
            './templates/**/*.twig'
        ],

        // These options are passed through directly to PurgeCSS
        options: {
            whitelistPatterns: [
                /embed-\w+/,
                /position-\w/,
                /iframe/,
                /bg-primary/,
                /bg-secondary/
            ]
        }
    }
}
