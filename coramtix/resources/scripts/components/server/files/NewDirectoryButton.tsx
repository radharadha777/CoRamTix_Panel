import React, { useState } from 'react';
import NewDirectoryDialog from '@/components/server/files/NewDirectoryDialog';
import { Button } from '@/components/elements/button/index';
import { useTranslation } from 'react-i18next';

export default ({ className }: { className?: string }) => {
    const { t } = useTranslation('server/files');
    const [visible, setVisible] = useState(false);

    return (
        <>
            <NewDirectoryDialog visible={visible} onDismissed={() => setVisible(false)} />
            <Button.Text onClick={() => setVisible(true)} className={className}>
                {t('create-directory')}
            </Button.Text>
        </>
    );
};
