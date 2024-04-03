import {currencyStore} from '../stores';
import {currencyApiService} from '../services';
import {mapFromCurrency} from '../utils';
import {toast} from 'react-toastify';

export const getCurrency = async () => {
    const {data, status} = await currencyApiService.get();

    if (status === 200) {
        currencyStore.setRequestTime();
        currencyStore.items = mapFromCurrency(data);
    }

    if (status === 404) {
        toast.info(`Service not found. Please check url`);
        currencyStore.clear();
    }
}