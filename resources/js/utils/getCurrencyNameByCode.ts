import {currencyCodes} from '../consts';

export const getCurrencyNameByCode = (code: number): string => {
    // @ts-ignore
    return currencyCodes[code];
}