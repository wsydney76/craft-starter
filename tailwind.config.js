module.exports = {
    // https://youtrack.jetbrains.com/issue/WEB-50318
    // This "hack" ensures your IDE detects all normal Tailwind classes, while JIT is used when compiling the project.
    // All the normal Tailwind classes should show up in code completion. It can't show all the new classes generated by JIT.
    mode: process.env.NODE_ENV ? 'jit' : undefined,

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
                '100': '25rem'
            },
            width: {
                '100': '25rem',
                '300px': '300px'
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
        require('@tailwindcss/forms'),
        require("tailwindcss-responsive-embed"),
        require('tailwindcss-aspect-ratio'),
    ],

    purge: {
        content: [
            './templates/**/*.twig'
        ]
    }
}
