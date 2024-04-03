import {generatePath} from 'react-router-dom';
import axios from 'axios';
import {loadingStore} from '../../stores';
import {API_BASE_URL} from '../../consts';

export const request = async (method: string, url: string, params: object = {}) => {
	const config = await axios.create({
		baseURL: API_BASE_URL
	});

	let instance;

	switch (method) {
		case 'POST': {
			instance = config.post(generatePath(url), { ...params });
			break;
		}
		case 'GET': {
			instance = config.get(generatePath(url), {params});
			break;
		}
		case 'PUT': {
			instance = config.put(generatePath(url), { ...params });
			break;
		}
		case 'DELETE': {
			instance = config.delete(generatePath(url));
			break;
		}
        default: {
            instance = config.get(generatePath(url), { ...params });
            break;
        }
    }

    loadingStore.loading = true;

	return await instance
                    .then((response) => response)
                    .catch((error) => error.response)
                    .finally(() => {loadingStore.loading = false; });
};
