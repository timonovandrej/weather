import {makeAutoObservable} from 'mobx';
import {CurrencyType} from '../types';
import {cloneDeep} from 'lodash';
import moment from 'moment';
import {getFormattedDate} from '../utils';

export const currencyStore = makeAutoObservable({
    requestTime: '',
    items: [] as CurrencyType[],

    get item():CurrencyType {
        return cloneDeep(this.items[0]);
    },

    setRequestTime() {
        this.requestTime = getFormattedDate(moment().unix());
    },

    clear() {
        this.items = [] as CurrencyType[];
        this.requestTime = '';
    },
})