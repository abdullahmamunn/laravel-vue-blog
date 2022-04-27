import  Vue from 'vue'
import  VueRouter from 'vue-router'

import dashboard from "../admin/dashboard";
//Users
import users from "../admin/users/user";
//Category
import categories from "../admin/categories/manage";
import addNew from "../admin/categories/add-new";
import editCategory from "../admin/categories/edit";
//Post
import posts from "../admin/post/manage";
import createPost from "../admin/post/add-new";
import editPost from "../admin/post/edit";

Vue.use(VueRouter);
export const routes = [
    { path: '/home', component: dashboard },

    { path: '/categories', component: categories, name: 'categories' },
    { path: '/users', component: users, name: 'users' },
    { path: '/add-new', component: addNew },
    { path: '/edit-category/:id', component: editCategory, name: 'categoryEdit'},

    { path: '/posts', component: posts, name: 'posts' },
    { path: '/create-post', component: createPost },
    { path: '/editPost/:id', component: editPost, name: 'postEdit'}

];
const router = new VueRouter({
    mode: "history",
    routes: routes,
});
export default router;
