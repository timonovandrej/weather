import {cloneDeep} from 'lodash';
import {GetParamsType} from '../../types';

export const mapToWeatherApi = (params: GetParamsType): GetParamsType => {
    const clone: any = cloneDeep(params);

    return {
        q: clone.q,
        units: clone.units ?? 'metric',
        'appid': clone.appid ?? 'e4b8b08c185638b825af37facfe1fabb'
    };
}