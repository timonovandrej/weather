import {Box, Button} from '@mui/material';
import {observer} from 'mobx-react-lite';
import {weatherStore} from '../stores';

export const stylesBox = {
    display: 'flex',
    gap: '10px',
    flexDirection: 'column',
    border: '1px solid #ccc',
    margin: '30px 0',
    padding: '0 10px 10px 10px'
};

export const Details = observer(() => {
    const {cityName, startAt, endAt} = weatherStore.details

    return (
        <Box sx={stylesBox}>
            <h3>{cityName}</h3>
            <b>Period</b>
            <div>Start at {startAt}</div>
            <div>End at {endAt}</div>

            <Button variant='contained' color='success'>Save forecast</Button>
        </Box>
    )
})