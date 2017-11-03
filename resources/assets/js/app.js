
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import VueRouter from 'vue-router';
window.Vue = require('vue');
Vue.use(VueRouter);
import Quotes from './components/Quotes.vue';
import NewQuote from './components/NewQuote.vue';
import SignUp from './components/SignUp.vue';
import Login from './components/Login.vue';

const routes = [
    {path: '', component: Quotes},
    {path: '/newQuote', component: NewQuote},
    {path: '/signup', component: SignUp},
    {path: '/login', component: Login},
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
});
