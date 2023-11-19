import {cloneDeep, orderBy} from 'lodash';
import {DetailsType} from '../../types';
import {getFormattedDate} from '../getFormattedDate';

export const mapFromDetails = (response: any): DetailsType => {
    const clone: any = cloneDeep(response);

    let list: any = clone.list.map((item:any) => ({dt: item.dt}));
    list = orderBy(list, [item => item.dt], ['asc']);

    return {
        cityName: clone.city.name,
        startAt: getFormattedDate(list[0].dt),
        endAt: getFormattedDate(list.pop().dt),
    }
}