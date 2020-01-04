import Vue from 'vue';
import VueRouter, { Route } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import GameList from '@/components/GameList.vue';
import GameShow from '@/views/PageGameShow.vue';
import GameCreate from '@/views/PageGameCreate.vue';
import store from '@/store';
import { Auth } from '@/utils/Auth';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  // Authentication
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/games',
    name: 'Games',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: GameList,
    props: true,
    beforeEnter: (to: Route, from: Route, next: Function): Function => {
      if (Auth.guest()) {
        return next({
          name: 'Login',
        });
      }
      return next();
    }
  },
  {
    path: '/games/create',
    name: 'GameCreate',
    component: GameCreate
  },
  {
    path: '/games/:id',
    name: 'GameShow',
    component: GameShow,
    props: true
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
