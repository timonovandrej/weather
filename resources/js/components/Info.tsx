import {Box, Button, Typography} from '@mui/material';
import {observer} from 'mobx-react-lite';
import {getCurrency} from '../actions';
import {currencyStore} from '../stores';
import {useEffect} from 'react';

export const stylesBox = {
    display: 'flex',
    gap: '10px',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    margin: '0 0 20px 0'
};

export const stylesInput = {
    display: 'flex',
    flexGrow: 1,
}

export const Info = observer(() => {
    useEffect(() => {
        currencyStore.setRequestTime()
    }, []);

    const {requestTime} = currencyStore;

    return (
        <Box sx={stylesBox}>
            <Typography
                component='h2'
                sx={stylesInput}
            >
                Last update: {requestTime}
            </Typography>
            <Button
                variant='contained'
                color='primary'
                onClick={getCurrency}
            >
                Refresh data
            </Button>
        </Box>
    )
});