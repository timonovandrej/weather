import {weatherStore} from '../stores';

export const changeCityName = (cityName:string) => {
    weatherStore.cityName = cityName;
}