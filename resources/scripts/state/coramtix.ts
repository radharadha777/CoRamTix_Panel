import { action, Action } from 'easy-peasy';

export interface CoRamTixSettings {
    logo: string;
    customCopyright: boolean;
    copyright: string;
    isUnderMaintenance: boolean;
    maintenance: string;
    themeSelector: boolean;
    allocationBlur: boolean;
    alertType: string;
    alertMessage: string;
}

export interface CoRamTixSettingsStore {
    data?: CoRamTixSettings;
    setCoRamTix: Action<CoRamTixSettingsStore, CoRamTixSettings>;
}

const coramtix: CoRamTixSettingsStore = {
    data: undefined,

    setCoRamTix: action((state, payload) => {
        state.data = payload;
    }),
};

export default coramtix;
