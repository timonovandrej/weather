import {request} from '../utils';
import {API_BASE_URL, API_WEATHER_GET_URL} from '../consts';
import {GetParamsType} from '../types';

export const weatherApiService = {
    get: async (params:GetParamsType) => await request(API_BASE_URL, 'GET', API_WEATHER_GET_URL, params),
}