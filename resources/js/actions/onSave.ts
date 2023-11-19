import {weatherDbService} from '../services';
import {mapToSaveWeather} from '../utils';
import {toast} from 'react-toastify';

export const onSave = async () => {
    const params = mapToSaveWeather();
    const {status} = await weatherDbService.save(params);

    if (status === 200) {
        toast.success('Item added successfully');
    } else {
        toast.warning('An error occurred while adding an item.');
    }
}