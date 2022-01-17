module.exports = {
    mode: 'jit',
    content: [
        './resources/**/*.{js,jsx,ts,tsx,vue,blade.php}',
    ],
    theme: {
        extend: {
            colors: {
                'primary': {
                    100: '#DCDEFE',
                    600: '#5139EF',
                    900: '#3521B5',
                },
            },
        },
    },
    plugins: [],
};
