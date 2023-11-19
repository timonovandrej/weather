import {SaveParamsType} from '../../types';
import {weatherStore} from '../../stores';

export const mapToSaveWeather = (): SaveParamsType => {
    const {cityName, item} = weatherStore;

    return {
        ...item,
        cityName,
    };
}