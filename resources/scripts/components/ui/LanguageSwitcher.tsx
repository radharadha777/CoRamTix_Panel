import React, { useState, useEffect } from 'react';
import i18n from '@/i18n';
import Select from '@/components/elements/Select';
import { useTranslation } from 'react-i18next';

const getLanguageLabel = (code: string) => {
    try {
        const displayNames = new Intl.DisplayNames([i18n.language], { type: 'language' });
        return displayNames.of(code) || code.toUpperCase();
    } catch {
        return code.toUpperCase();
    }
};

const LanguageSwitcher: React.FC = () => {
    const { t } = useTranslation('dashboard/account');
    const [languages, setLanguages] = useState<string[]>([]);
    const [currentLang, setCurrentLang] = useState(i18n.language);

    useEffect(() => {
        fetch('/locales/list.json')
            .then((res) => res.json())
            .then((langs) => setLanguages(langs))
            .catch(() => setLanguages(['en']));

        const onLangChanged = (lng: string) => setCurrentLang(lng);
        i18n.on('languageChanged', onLangChanged);

        return () => {
            i18n.off('languageChanged', onLangChanged);
        };
    }, []);

    const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const newLang = e.target.value;
        i18n.changeLanguage(newLang);
    };

    return (
        <div className='flex justify-between items-center mb-2'>
            <p className='flex-1'>{t('overview.language')}</p>
            <Select className='!pr-15 !w-auto' value={currentLang} onChange={handleChange}>
                {languages.map((lang) => (
                    <option key={lang} value={lang}>
                        {getLanguageLabel(lang)}
                    </option>
                ))}
            </Select>
        </div>
    );
};

export default LanguageSwitcher;
