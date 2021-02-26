import  Vue from 'vue'
import  VueRouter from 'vue-router'

import dashboard from "../admin/dashboard";
import categories from "../admin/categories/manage";

Vue.use(VueRouter);
export const routes = [
    { path: '/home', component: dashboard },
    { path: '/categories', component: categories }
];
const router = new VueRouter({
    routes: routes,
    mode: 'history',
});
export default router;
