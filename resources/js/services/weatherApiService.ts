import {request} from '../utils';
import {API_WEATHER_BASE_URL, API_WEATHER_GET_URL} from '../consts';

export type GetParamsType = {
    q: string,
    units?: string,
    appid?: string;
}

export const weatherApiService = {
    get: async (params:GetParamsType) => await request(API_WEATHER_BASE_URL, 'GET', API_WEATHER_GET_URL, params),
    // store: async (params: object) => await request('POST', API_SOLAR, params),
}