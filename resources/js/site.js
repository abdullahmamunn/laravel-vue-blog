
require('./bootstrap');
import Vue from 'vue'

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
