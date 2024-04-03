import {request} from '../utils';
import {API_BASE_URL, API_GET_CURRENCY} from '../consts';

export const currencyApiService = {
    get: async () => await request('GET', API_GET_CURRENCY),
}