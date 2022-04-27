import  Vue from 'vue'
import  VueRouter from 'vue-router'

import { createRouter, createWebHistory } from 'vue-router'


import home from "../site/home";
import about from "../site/about";
import services from "../site/services";
import contact from "../site/contact";
import categoryView from "../site/category-view";
import singlePost from "../site/single-post";
import recentPost from "../site/recentpost";
import allRecentPosts from "../site/all-recents-posts";

Vue.use(VueRouter);
export const routes = [
    { path: '/', component: home },
    { path: '/about', component: about },
    { path: '/services', component: services },
    { path: '/contact', component: contact },
    { path: '/category-view/:slug', component: categoryView, name:'categoryShow' },
    { path: '/single-post/:id', component: singlePost, name:'singlePost'},
    { path: '/recent-post/:slug', component: recentPost, name:'recentPost' },
    { path: '/all-recent-posts/', component: allRecentPosts, name:'view-all-posts' },
];
const router = new VueRouter({
    routes: routes,
    // mode: 'history',
});

// const router = createRouter({
//     history: createWebHistory(),
//     routes: routes,
//   })
export default router;
