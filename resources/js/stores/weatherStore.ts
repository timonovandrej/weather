import {makeAutoObservable} from 'mobx';
import {DetailsType, WeatherType} from '../types';

export const weatherStore = makeAutoObservable({
    cityName: '',
    items: [] as WeatherType[],
    details: {} as DetailsType,

    clear() {
        this.items = [] as WeatherType[];
        this.cityName = '';
        this.details = {} as DetailsType;
    },
})