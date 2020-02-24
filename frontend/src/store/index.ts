import Vue from "vue";
import Vuex from "vuex";
import { IUser } from '@/Interfaces/interfaces';

Vue.use(Vuex);

interface StateInterface {
  user: IUser | null,
  token: number|null;
}

const state: StateInterface = {
  user: null,
  token: null,
};

export default new Vuex.Store({
  state,
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setToken(state, token) {
      state.token = token;
    },
    unsetUser(state) {
      state.user = null;
    },
    unsetToken(state) {
      state.token = null;
    }
  },
  actions: {
    login({ state, commit }, payload) {
      if (!state.user) {
        commit('setUser', payload.user);
        commit('setToken', payload.token);
      }
    },

    logout({ state, commit }) {
      if (state.user) {
        commit('unsetUser');
        commit('unsetToken');
      }
    }
  },
  modules: {}
});
