import {cloneDeep} from 'lodash';
import {WeatherType} from '../../types';
import {getFormattedDate} from '../getFormattedDate';

export const mapFromWeather = (response: any): WeatherType[] => {
    const clone: any = cloneDeep(response);

    return clone.list.map((item: any) => {
        const {dt, wind} = item;
        const {temp_max, temp_min} = item.main;

        return {
            minTmp: temp_min,
            maxTmp: temp_max,
            windSpd: wind.speed,
            timestamp: dt,
            date: getFormattedDate(dt),
        }
    });
}