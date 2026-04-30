import 'bootstrap';
import axios from 'axios';

window.axios = axios;

// Set default headers for AJAX requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
