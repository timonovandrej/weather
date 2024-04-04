import {makeAutoObservable} from 'mobx';
import {CurrencyType} from '../types';
import {cloneDeep} from 'lodash';
import moment from 'moment';
import {getFormattedDate} from '../utils';

export const currencyStore = makeAutoObservable({
    requestTime: '',
    items: [] as CurrencyType[],

    updateItems(items:CurrencyType[] ) {
        const clone = cloneDeep(this.items);

        this.items = {...clone, ...items}
    },

    setRequestTime() {
        this.requestTime = getFormattedDate(moment().unix());
    },

    clear() {
        this.items = [] as CurrencyType[];
        this.requestTime = '';
    },
})