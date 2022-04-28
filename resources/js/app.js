
require('./bootstrap');

window.Vue = require('vue');

import $ from 'jquery';
window.$ = window.jQuery = $;

// import 'jquery-ui/ui/widgets/datepicker.js';
import'admin-lte/plugins/datatables/jquery.dataTables.min.js';
import'admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
import'admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js';
import'admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js';
import'admin-lte/plugins/select2/js/select2.full.min.js';
//Don't forgot to put code also same as below otherwise it will not working

// // Datepicket Code
// $('#datepicker').datepicker();
//
// //Datatable
// $("#example1").DataTable({
//     "responsive": true,
//     "autoWidth": false,
// });

//Initialize Select2 Elements
$('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
});
// ..........similarly other scripts comes
//vue form validation
import Vue from 'vue'
import { Form, HasError, AlertError } from 'vform'
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
// vue-router
import VueRouter from 'vue-router'
import router from './routes/routes'
Vue.use(VueRouter);

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

//Vuex
import Vuex from 'vuex'
Vue.use(Vuex);
import storeData from './store/store.js'
const store = new Vuex.Store(
    storeData
);
// user vue filter
import {moment} from './filter/filter';

// use vue mixin
import './helpers/mixin';
// pagination
Vue.component('pagination', require('laravel-vue-pagination'));
// vue ckEditor
import CKEditor from '@ckeditor/ckeditor5-vue2';
Vue.use( CKEditor );

import VueEditor from 'vue2-editor'
Vue.use(VueEditor)

const app = new Vue({
    el: '#app',
    router,
    store
});
