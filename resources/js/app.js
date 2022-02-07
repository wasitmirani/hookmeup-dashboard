/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import router from "./router";
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import Swal from 'sweetalert2'
import moment from "moment";
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css' //Vuesax styles
Vue.use(Vuesax);

import { BootstrapVue, BootstrapVueIcons } from 'bootstrap-vue'
window.Swal = Swal;
window.moment = moment;
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(VueToast);



Vue.filter("timeformat", function(value) {
    if (value) {
        return moment
            .utc(String(value))
            .local()
            .fromNow();
    }
});
Vue.filter("planeStatus", function(value) {
    switch (value) {
        case "1":
            return `<span class = "badge rounded-pill badge-light-primary me-1 mt-2" > Free Membership </span>`;
            break;
        case "2 ":
            return `<span class = "badge rounded-pill badge-light-success me-1 mt-2" > Customize  Membership </span>`;
            break;
        case "3 ":
            return `<span class = "badge rounded-pill badge-light-info me-1 mt-2" > Premium Membership </span>`;
            break;
        default:
            return `<span class = "badge rounded-pill badge-light-primary me-1 mt-2" > Free Membership </span>`;
            break;
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});