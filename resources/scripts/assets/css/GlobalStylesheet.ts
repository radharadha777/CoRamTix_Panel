import tw from 'twin.macro';
import { createGlobalStyle } from 'styled-components/macro';

export default createGlobalStyle`
    body {
        ${tw`font-sans bg-gradient-to-br from-gray-900 via-purple-900 to-indigo-900 text-white`};
        letter-spacing: 0.015em;
    }

    h1, h2, h3, h4, h5, h6 {
        ${tw`font-bold tracking-tight font-header`};
    }

    p {
        ${tw`text-white/80 leading-relaxed font-sans`};
    }

    form {
        ${tw`m-0`};
    }

    textarea, select, input, button, button:focus, button:focus-visible {
        ${tw`outline-none`};
    }

    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield !important;
    }

    /* Premium Scroll Bar */
    ::-webkit-scrollbar {
        background: transparent;
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(168, 85, 247, 0.6);
        border-radius: 10px;
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(168, 85, 247, 0.8);
        border-radius: 10px;
        border: 2px solid transparent;
        background-clip: padding-box;
    }

    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }
`;
