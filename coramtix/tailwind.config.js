const colors = require('tailwindcss/colors');

function coramtix(variable) {
  return ({ opacityValue }) =>
    opacityValue !== undefined
      ? `rgb(var(${variable}) / ${opacityValue})`
      : `rgb(var(${variable}))`;
}

const gray = {
    50: coramtix('--color-50'),
    100: coramtix('--color-100'),
    200: coramtix('--color-200'),
    300: coramtix('--color-300'),
    400: coramtix('--color-400'),
    500: coramtix('--color-500'),
    600: coramtix('--color-600'),
    700: coramtix('--color-700'),
    800: coramtix('--color-800'),
    900: coramtix('--color-900'),
};

module.exports = {
    content: [
        './resources/scripts/**/*.{js,ts,tsx}',
    ],
    theme: {
        extend: {
            fontFamily: {
                header: ['"IBM Plex Sans"', '"Roboto"', 'system-ui', 'sans-serif'],
                sans: ["var(--font-family)"], 
            },
            colors: {
                black: '#131a20',
                // "primary" and "neutral" are deprecated, prefer the use of "blue" and "gray"
                // in new code.
                primary: colors.blue,
                gray: gray,
                neutral: gray,
                cyan: colors.cyan,
                coramtix: coramtix('--color-primary'),
                success: coramtix('--color-success'),
                danger: coramtix('--color-danger'),
                secondary: coramtix('--color-secondary'),
            },
            fontSize: {
                '2xs': '0.625rem',
            },
            transitionDuration: {
                250: '250ms',
            },
            borderColor: theme => ({
                default: theme('colors.neutral.400', 'currentColor'),
            }),
            borderRadius: {
                ui: 'var(--radius)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/forms')({
            strategy: 'class',
        }),
    ]
};