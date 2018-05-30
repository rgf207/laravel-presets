
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Form from './classes/Form';
window.Form = Form;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('Orders', require('./components/Orders.vue'));
Vue.component('Order', require('./components/Order.vue'));
Vue.component('Paginator', require('./components/Paginator.vue'));
Vue.component('ContactForm', require('./components/ContactForm'));
Vue.component('OrderForm', require('./components/OrderForm'));

const app = new Vue({
    el: '#app'
});
