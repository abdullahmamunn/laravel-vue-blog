
require('./bootstrap');
import Vue from 'vue'

// Vue Form
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
window.Form = Form;
Vue.component(HasError.name, HasError);

// vue-router
import VueRouter from 'vue-router'
import router from './routes/site-routes'
Vue.use(VueRouter);

//Vuex
import Vuex from 'vuex'
Vue.use(Vuex);
import storeData from './store/store.js'
const store = new Vuex.Store(
    storeData
);

// Sweet Alert
import Swal from 'sweetalert2'
window.Swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Toast = Toast;

// Toastr js
import toastr from 'toastr'
window.toastr = toastr;

// user vue filter
import {moment} from './filter/filter';

// use vue mixin
import './helpers/mixin';
// pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//Lazy loader
// import VueClazyLoad from 'vue-clazy-load'
var VueClazyLoad = require('vue-clazy-load');
Vue.use(VueClazyLoad);

const app = new Vue({
    el: '#app2',
    router,
    store
});
