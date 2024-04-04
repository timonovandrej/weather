import {request} from '../utils';
import {API_GET_CURRENCY} from '../consts';

export const currencyService = {
    get: async () => await request('GET', API_GET_CURRENCY),
}