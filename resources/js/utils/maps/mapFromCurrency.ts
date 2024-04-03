import {cloneDeep} from 'lodash';
import {CurrencyType} from '../../types';
import {getCurrencyNameByCode} from '../getCurrencyNameByCode';

export const mapFromCurrency = (response: any): CurrencyType[] => {
    const clone: any = cloneDeep(response);

    return clone.map((item: any) => {
        const codeA = getCurrencyNameByCode(item.codeA);
        const codeB = getCurrencyNameByCode(item.codeB);

        return {...item, codeA, codeB}
    });
}