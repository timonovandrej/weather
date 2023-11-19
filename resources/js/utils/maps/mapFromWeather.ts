import {cloneDeep} from 'lodash';
import {WeatherType} from '../../types';

export const mapFromWeather = (response: any): WeatherType[] => {
    const clone: any = cloneDeep(response);

    return clone.list.map((item: any) => {
        const {dt, dt_txt, wind} = item;
        const {temp_max, temp_min} = item.main;
        console.log()
        return {
            minTmp: temp_min,
            maxTmp: temp_max,
            windSpd: wind.speed,
            timestamp: dt,
            date: dt_txt,
        }
    });
}