import {cloneDeep} from 'lodash';
import {DetailsType} from '../../types';
import {getFormattedDate} from '../getFormattedDate';
import {getTimestampFromDate} from '../getTimestampFromDate';

export const mapFromOneDetails = (response: any): DetailsType => {
    const clone: any = cloneDeep(response);

    const {city_name, timestamp_dt} = clone;
    const timestamp = getTimestampFromDate(timestamp_dt);

    return {
        cityName: city_name,
        startAt: getFormattedDate(timestamp),
        endAt: getFormattedDate(timestamp),
    }
}