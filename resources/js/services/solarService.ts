import {request} from 'utils';
import {API_SOLAR} from 'consts';

export const solarService = {
    index: async () => await request('GET', API_SOLAR),
    store: async (params: object) => await request('POST', API_SOLAR, params),
}