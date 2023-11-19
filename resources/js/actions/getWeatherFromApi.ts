import {weatherStore} from '../stores';
import {weatherApiService} from '../services';
import {mapFromDetails, mapFromWeather, mapToWeatherApi} from '../utils';
import {toast} from 'react-toastify';

export const getWeatherFromApi = async () => {
    const q = weatherStore.cityName;
    const params = mapToWeatherApi({q})

    const {data, status} = await weatherApiService.get(params);

    if (status === 200) {
        weatherStore.items = mapFromWeather(data);
        weatherStore.details = mapFromDetails(data);
    }

    if (status === 404) {
        toast.info(`Data for city ${q} not found. Please choose another name`);
        weatherStore.clear();
    }
}