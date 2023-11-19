import {makeAutoObservable} from 'mobx';
import {DetailsType, WeatherType} from '../types';
import {cloneDeep} from 'lodash';

export const weatherStore = makeAutoObservable({
    cityName: '',
    items: [] as WeatherType[],
    details: {} as DetailsType,

    get item():WeatherType {
        return cloneDeep(this.items[0]);
    },

    clear() {
        this.items = [] as WeatherType[];
        this.cityName = '';
        this.details = {} as DetailsType;
    },
})