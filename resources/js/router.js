import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import HomePage from './pages/HomePage';
import SingolPost from './pages/SingolPost';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/anime/:slug',
            name: 'anime',
            component: SingolPost
        },
    ] 
});

export default router;
