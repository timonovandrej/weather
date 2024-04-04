import Pusher, {Options} from 'pusher-js';
import Echo from 'laravel-echo';
import {onNotificationUpdate} from '../actions';

export const initSockets = async () => {
    const port = import.meta.env.VITE_APP_PUSHER_PORT ?? 6001;
    const options:Options = {
        cluster: String(import.meta.env.VITE_APP_PUSHER_CLUSTER),
        wsHost: String(import.meta.env.VITE_APP_SOCKET_URL),
        wsPort: Number(port),
        wssPort: Number(port),
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
    };

    const channels = new Echo({
        broadcaster: 'pusher',
        client: new Pusher(String(import.meta.env.VITE_APP_PUSHER_KEY), options),
    });

    await notificationChannel(channels);
}

const notificationChannel = async (channels:Echo) => {
    channels
        .channel('public.notification')
        .listen('.update', onNotificationUpdate);
}

export const socketService = {
    initSockets,
};