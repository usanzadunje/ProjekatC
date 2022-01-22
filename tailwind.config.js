module.exports = {
    mode: 'jit',
    content: [
        './resources/**/*.{js,jsx,ts,tsx,vue,blade.php}',
    ],
    theme: {
        extend: {
            screens: {
                'xs': '396px',
            },
            colors: {
                'primary': {
                    100: '#DCDEFE',
                    600: '#5139EF',
                    900: '#3521B5',
                },
                'primary-paint': {
                    300: '#F3F5F7',
                },
            },
        },
    },
    plugins: [],
};
