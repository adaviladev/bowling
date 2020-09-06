import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import GameList from '@/components/GameList.vue';
import GameShow from '@/views/PageGameShow.vue';
import GameCreate from '@/views/PageGameCreate.vue';
import { auth } from '@/router/Middleware/Authenticate';
import { guest } from '@/router/Middleware/Guest';
import { can } from '@/router/Middleware/Authorize';
import middleware from './Middleware';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  // Authentication
  {
    path: '/login',
    name: 'Login',
    component: Login,
    beforeEnter: middleware([guest]),
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    beforeEnter: middleware([guest]),
  },
  {
    path: '/games',
    name: 'Games',
    component: GameList,
    props: true,
    beforeEnter: middleware([auth]),
  },
  {
    path: '/games/:id',
    name: 'GameShow',
    component: GameShow,
    props: true,
    beforeEnter: middleware([auth]),
  },
  {
    path: '/games/create',
    name: 'GameCreate',
    component: GameCreate,
    beforeEnter: middleware([can('create-games')]),
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
