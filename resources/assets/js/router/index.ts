// tslint:disable:object-literal-sort-keys
import Vue from 'vue';
import Router from 'vue-router';
import GameList from '../components/GameList/index.vue';
import GameShow from '../pages/PageGameShow/index.vue';
import Home from '../pages/PageHome/index.vue';

Vue.use(Router);

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home,
      props: true,
    },
    {
      path: '/games',
      name: 'Games',
      component: GameList,
      props: true,
    },
    {
      path: '/games/:id',
      name: 'GameShow',
      component: GameShow,
      props: true,
    },
  ],
  mode: 'history',
});
