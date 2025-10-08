import React, { useEffect } from 'react';
import { ServerContext } from '@/state/server';
import { Form, Formik, FormikHelpers } from 'formik';
import Field from '@/components/elements/Field';
import { join } from 'path';
import { object, string } from 'yup';
import createDirectory from '@/api/server/files/createDirectory';
import tw from 'twin.macro';
import { Button } from '@/components/elements/button';
import { FileObject } from '@/api/server/files/loadDirectory';
import { useFlashKey } from '@/plugins/useFlash';
import useFileManagerSwr from '@/plugins/useFileManagerSwr';
import FlashMessageRender from '@/components/FlashMessageRender';
import Modal from '@/components/elements/Modal';
import Code from '@/components/elements/Code';

interface Props {
    visible: boolean;
    onDismissed: () => void;
}

interface Values {
    directoryName: string;
}

const schema = object().shape({
    directoryName: string().required('A valid directory name must be provided.'),
});

const generateDirectoryData = (name: string): FileObject => ({
    key: `dir_${name.split('/', 1)[0] ?? name}`,
    name: name.replace(/^(\/*)/, '').split('/', 1)[0] ?? name,
    mode: 'drwxr-xr-x',
    modeBits: '0755',
    size: 0,
    isFile: false,
    isSymlink: false,
    mimetype: '',
    createdAt: new Date(),
    modifiedAt: new Date(),
    isArchiveType: () => false,
    isEditable: () => false,
});

const NewDirectoryDialog: React.FC<Props> = ({ visible, onDismissed }) => {
    const uuid = ServerContext.useStoreState((state) => state.server.data!.uuid);
    const directory = ServerContext.useStoreState((state) => state.files.directory);
    const { mutate } = useFileManagerSwr();
    const { clearAndAddHttpError } = useFlashKey('files:directory-modal');

    useEffect(() => {
        return () => {
            clearAndAddHttpError();
        };
    }, []);

    const submit = ({ directoryName }: Values, { setSubmitting }: FormikHelpers<Values>) => {
        createDirectory(uuid, directory, directoryName)
            .then(() => mutate((data) => [...data, generateDirectoryData(directoryName)], false))
            .then(() => onDismissed())
            .catch((error) => {
                setSubmitting(false);
                clearAndAddHttpError(error);
            });
    };

    return (
        <Modal visible={visible} onDismissed={onDismissed} dismissable top>
            <h2 css={tw`text-lg font-semibold mb-4 text-white`}>Create Directory</h2>
            <Formik onSubmit={submit} validationSchema={schema} initialValues={{ directoryName: '' }}>
                {({ submitForm, values }) => (
                    <>
                        <FlashMessageRender key={'files:directory-modal'} />
                        <Form css={tw`m-0`}>
                            <Field autoFocus id={'directoryName'} name={'directoryName'} label={'Name'} />
                            <p css={tw`mt-2 text-sm md:text-base break-all`}>
                                <span css={tw`text-neutral-200`}>This directory will be created as&nbsp;</span>
                                <Code>
                                    /home/container/
                                    <span css={tw`text-cyan-200`}>
                                        {join(directory, values.directoryName).replace(/^(\.\.\/|\/)+/, '')}
                                    </span>
                                </Code>
                            </p>
                            <div css={tw`flex justify-end gap-2 mt-6`}>
                                <Button.Text type='button' onClick={onDismissed}>
                                    Cancel
                                </Button.Text>
                                <Button type='button' onClick={submitForm}>
                                    Create
                                </Button>
                            </div>
                        </Form>
                    </>
                )}
            </Formik>
        </Modal>
    );
};

export default NewDirectoryDialog;
