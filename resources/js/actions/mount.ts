import {socketService} from '../services';
import {getCurrency} from './getCurrency';

export const mount = async () => {
    await getCurrency();
    await socketService.initSockets();
}