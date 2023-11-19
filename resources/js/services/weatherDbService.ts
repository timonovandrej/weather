import {request} from '../utils';
import {API_DB_BASE_URL, API_DB_WEATHER_URL} from '../consts';
import {SaveParamsType} from '../types';

export const weatherDbService = {
    save: async (params: SaveParamsType) => await request(API_DB_BASE_URL, 'POST', API_DB_WEATHER_URL, params),
    get: async (cityName: string) => await request(API_DB_BASE_URL, 'GET', API_DB_WEATHER_URL, {cityName}),
}