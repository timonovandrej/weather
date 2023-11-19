import {weatherStore} from '../stores';
import {weatherDbService} from '../services';
import {mapFromOneDetails, mapFromOneWeather} from '../utils';
import {toast} from 'react-toastify';

export const getWeatherFromDb = async () => {
    const {cityName} = weatherStore;

    const {data, status} = await weatherDbService.get(cityName);

    if (status === 200) {
        if (data.data) {
            weatherStore.items = mapFromOneWeather(data.data);
            weatherStore.details = mapFromOneDetails(data.data);
        } else {
            toast.info(`Data for city ${cityName} not found`);
            weatherStore.clear();
        }
    } else {
        toast.error('Error. Please contact our development team');
        weatherStore.clear();
    }
}