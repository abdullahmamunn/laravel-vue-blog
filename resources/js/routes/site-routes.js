import  Vue from 'vue'
import  VueRouter from 'vue-router'

import home from "../site/home";
import about from "../site/about";
import services from "../site/services";
import contact from "../site/contact";
import categoryView from "../site/category-view";
import singlePost from "../site/single-post";

Vue.use(VueRouter);
export const routes = [
    { path: '/', component: home },
    { path: '/about', component: about },
    { path: '/services', component: services },
    { path: '/contact', component: contact },
    { path: '/category-view/:slug', component: categoryView, name:'categoryShow' },
    { path: '/single-post/:id', component: singlePost, name:'singlePost'},
];
const router = new VueRouter({
    routes: routes,
    // mode: 'history',
});
export default router;
