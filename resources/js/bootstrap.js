window._ = require("lodash");
import * as L from 'leaflet'
//import Bundle from "bootstrap/dist/js/bootstrap.bundle.min";
// import swal from "sweetalert2";
// window.swal = swal;

try {
   window.L = L;
//   window.$ = window.jQuery = require('jquery');
 // window.Bundle = Bundle;
// require("datatables.net-bs5");
//    require("../../node_modules/bootstrap-select/dist/js/bootstrap-select.min");
 //  window.Popper = require("popper.js").default;
    require("bootstrap");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });

