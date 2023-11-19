import moment from 'moment';

export const getTimestampFromDate = (date: string): number => {
    return moment(date).unix();
}