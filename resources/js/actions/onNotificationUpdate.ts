import {currencyStore} from '../stores';
import {mapFromCurrency} from '../utils';

export const onNotificationUpdate = (event:any) => {
    if (event.data && event.data.length > 0) {
        const items = mapFromCurrency(event.data);

        currencyStore.updateItems(items);
        currencyStore.setRequestTime();
    }
};
