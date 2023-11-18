import {makeAutoObservable} from 'mobx';
import {WeatherType} from "../types";

export const weatherStore = makeAutoObservable({
    items: [] as WeatherType[],

    clear() {
        this.items = [] as WeatherType[];
    },
})