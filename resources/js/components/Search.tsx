import {Box, Button, TextField} from '@mui/material';
import {observer} from 'mobx-react-lite';
import {weatherStore} from '../stores';
import {changeCityName, getWeatherFromApi, getWeatherFromDb} from '../actions';

export const stylesBox = {
    display: 'flex',
    gap: '10px',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
};

export const stylesInput = {
    display: 'flex',
    flexGrow: 1,
}

export const Search = observer(() => {
    const {cityName} = weatherStore;
    const isButtonDisabled = cityName.length < 4;

    return (
        <Box sx={stylesBox}>
            <TextField
                variant='outlined'
                sx={stylesInput}
                value={cityName}
                onChange={(event) => changeCityName(event.currentTarget.value)}
                placeholder='The city name must be more than 3 characters'
            />

            <Button
                variant='outlined'
                color='primary'
                onClick={getWeatherFromApi}
                disabled={isButtonDisabled}
            >
                Get from api
            </Button>

            <Button
                variant='contained'
                color='primary'
                onClick={getWeatherFromDb}
                disabled={isButtonDisabled}
            >
                Get from DB
            </Button>
        </Box>
    )
});