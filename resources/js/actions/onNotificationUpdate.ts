import {currencyStore} from '../stores';
import {mapFromCurrency} from '../utils';

export const onNotificationUpdate = (event:any) => {
    if (event.data) {
        const items = mapFromCurrency(event.data);

        currencyStore.updateItems(items);
        currencyStore.setRequestTime();
    }
};
