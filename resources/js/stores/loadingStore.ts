import { makeAutoObservable } from 'mobx';

export const loadingStore = makeAutoObservable({
	loading: false,
});
