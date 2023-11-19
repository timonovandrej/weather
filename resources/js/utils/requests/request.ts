import {generatePath} from 'react-router-dom';
import axios from 'axios';
import {loadingStore} from '../../stores';

export const request = async (baseURL:string, method: string, url: string, params: object = {}) => {
	const config = await axios.create({
		baseURL,
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
