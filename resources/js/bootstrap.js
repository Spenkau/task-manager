import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import axios from 'axios';
// import * as Popper from '@popperjs/core'
// import lodash from 'lodash';

// window.Popper = Popper

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: 6001,
    wssPort: 6001,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    encrypted: true,
    forceTLS: false,
    disableStats: true,
    enabledTransports: ['ws', 'wss']
});





