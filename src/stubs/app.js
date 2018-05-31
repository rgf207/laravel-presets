require('./bootstrap');

window.Vue = require('vue');

import Form from './classes/Form';
window.Form = Form;

const app = new Vue({
    el: '#app'
});
