import {cloneDeep} from 'lodash';
import {WeatherType} from '../../types';
import {getFormattedDate} from '../getFormattedDate';
import {getTimestampFromDate} from '../getTimestampFromDate';

export const mapFromOneWeather = (response: any): WeatherType[] => {
    const clone: any = cloneDeep(response);
    const {min_tmp, max_tmp, wind_spd, timestamp_dt} = clone;
    const timestamp = getTimestampFromDate(timestamp_dt);

    return [
        {
            minTmp: min_tmp,
            maxTmp: max_tmp,
            windSpd: wind_spd,
            timestampDt: timestamp,
            date: getFormattedDate(timestamp),
        }
    ];
}