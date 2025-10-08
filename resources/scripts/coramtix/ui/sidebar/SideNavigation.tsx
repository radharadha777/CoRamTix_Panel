import styled from 'styled-components/macro';
import tw from 'twin.macro';

export const SideNavigation = styled.div`
    ${tw`flex flex-col gap-1 pb-4 -mt-1`};

    & .label {
        ${tw`flex items-center ml-2 mr-2 px-3 pt-2 pb-1 text-sm font-semibold text-gray-100 uppercase rounded-ui transition-all duration-300`};
    }
    a {
        ${tw`flex items-center ml-2 mr-2 px-5 py-2 text-sm font-medium text-gray-200 rounded-ui transition-all duration-300`};

        &:hover,
        &:focus,
        &.active {
            ${tw`text-coramtix`};
            background-color: rgb(var(--color-primary) / 0.2);
        }
    }
`;
