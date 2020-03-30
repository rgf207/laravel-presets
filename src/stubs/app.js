require('./bootstrap');

window.Vue = require('vue');

import Form from 'form-class';
window.Form = Form;

const app = new Vue({
    el: '#app'
});
