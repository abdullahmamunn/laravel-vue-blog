import  Vue from 'vue'
import  VueRouter from 'vue-router'

import dashboard from "../admin/dashboard";
import categories from "../admin/categories/manage";
import addNew from "../admin/categories/add-new";
import editCategory from "../admin/categories/edit";

Vue.use(VueRouter);
export const routes = [
    { path: '/home', component: dashboard },
    { path: '/categories', component: categories, name: 'categories' },
    { path: '/add-new', component: addNew },
    { path: '/edit-category/:id', component: editCategory, name: 'categoryEdit'}
];
const router = new VueRouter({
    routes: routes,
    // mode: 'history',
});
export default router;
