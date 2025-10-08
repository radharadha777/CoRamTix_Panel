import React from 'react';
import styled from 'styled-components/macro';
import tw from 'twin.macro';
import { SideNavigation } from './sidebar/SideNavigation';
import { Link, NavLink } from 'react-router-dom';
import Avatar from '@/components/ui/Avatar';
import { useStoreState } from 'easy-peasy';
import { ApplicationStore } from '@/state';
import { ExternalLinkIcon, ServerIcon } from '@heroicons/react/solid';

interface Props {
    isOpen?: boolean;
    children?: React.ReactNode;
    dashboard?: boolean;
}

const Container = styled.div<{ isOpen: boolean }>`
    ${tw`w-[225px] self-start m-3 border border-gray-600 rounded-ui bg-gray-700 text-white flex flex-col z-40 transition-transform duration-300 ease-in-out`};

    ${({ isOpen }) =>
        isOpen
            ? tw`fixed top-16 left-0 translate-x-0 h-[calc(100vh-64px)] overflow-y-auto`
            : tw`-translate-x-full hidden`}

    @media (min-width: 1024px) {
        position: fixed;
        top: 64px;
        left: 0;
        transform: translateX(0);
        display: flex;
        height: calc(100vh - 100px);
        overflow-y: auto;
    }
`;

const Sidebar = ({ children, isOpen = false, dashboard = false }: Props) => {
    const nameFirst = useStoreState((state) => state.user.data?.name_first);
    const nameLast = useStoreState((state) => state.user.data?.name_last);
    const rootAdmin = useStoreState((state) => state.user.data!.rootAdmin);
    const name = useStoreState((state: ApplicationStore) => state.settings.data!.name);
    return (
        <Container isOpen={isOpen}>
            <div className='sticky w-fit text-white p-4 rounded-ui'>
                <div className='flex items-center gap-3'>
                    <Link to='/account'>
                        <Avatar className='w-10' />
                    </Link>
                    <div className='flex flex-col'>
                        <div className={'flex items-center gap-x-1'}>
                            <span className='text-xs tracking-widest uppercase text-white/50'>
                                {rootAdmin ? 'Administrator' : name + ' User'}
                            </span>
                            {rootAdmin && (
                                // eslint-disable-next-line react/jsx-no-target-blank
                                <a href={`/admin`} target={'_blank'} className='h-5 w-5 text-white/70'>
                                    <ExternalLinkIcon />
                                </a>
                            )}
                        </div>
                        <Link to='/account'>
                            <span className='text-sm font-semibold'>
                                {nameFirst} {nameLast}
                            </span>
                        </Link>
                    </div>
                </div>
            </div>
            {dashboard && (
                <SideNavigation>
                    <NavLink to='/' exact>
                        <ServerIcon className={`w-5 mr-1`} /> Dashboard
                    </NavLink>
                </SideNavigation>
            )}
            {children && <SideNavigation>{children}</SideNavigation>}
        </Container>
    );
};

export default Sidebar;
