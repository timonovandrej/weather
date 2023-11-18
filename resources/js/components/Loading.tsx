import React from 'react';
import {observer} from 'mobx-react-lite';
import {Box, CircularProgress} from '@mui/material';
import {loadingStore} from "../stores";

const stylesBox = {
    width: '100%',
    height: '100%',
    position: 'absolute',
    zIndex: 1500,
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
    cursor: 'wait',
}

export const Loading = observer(() => {
    const {loading} = loadingStore;

    if (!loading) {
        return <div />
    }

	return (
        <Box sx={stylesBox}>
            <CircularProgress color='primary' size={100} />
        </Box>
    );
});
