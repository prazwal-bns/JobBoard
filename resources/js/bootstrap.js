import Alpine from 'alpinejs';
import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.Alpine = Alpine;

Alpine.start();
