import moment from 'moment';

export const getFormattedDate = (timestamp: number): string => {
    return moment.unix(timestamp).format('YYYY-MM-DD h:mm a');
}