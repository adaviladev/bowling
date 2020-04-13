import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '@/views/Home.vue';
import Login from '@/views/Login.vue';
import Register from '@/views/Register.vue';
import GameList from '@/components/GameList.vue';
import GameShow from '@/views/PageGameShow.vue';
import GameCreate from '@/views/PageGameCreate.vue';
import { isAuthenticated } from '@/utils/Middleware/Guard';

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
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
  {
    path: '/games',
    name: 'Games',
    component: GameList,
    props: true,
    beforeEnter: isAuthenticated,
  },
  {
    path: '/games/:id',
    name: 'GameShow',
    component: GameShow,
    props: true,
    beforeEnter: isAuthenticated,
  },
  {
    path: '/games/create',
    name: 'GameCreate',
    component: GameCreate,
  },
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes,
});

export default router;
