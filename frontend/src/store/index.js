import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const state = {
  user: null,
  token: null,
};

export const storeConfig = {
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
    },
  },
  actions: {
    checkLocalStorage({ commit }) {
      commit('setUser', JSON.parse(localStorage.user));
      commit('setToken', localStorage.token);

      if (localStorage.token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${(localStorage.token)}`;
      }
    },

    login({ state, commit }, payload) {
      if (!state.user) {
        commit('setUser', payload.user);
        commit('setToken', payload.token);
        localStorage.user = JSON.stringify(payload.user);
        localStorage.token = payload.token;
      }
    },

    logout({ state, commit }) {
      if (state.user) {
        commit('unsetUser');
        commit('unsetToken');
      }

      delete localStorage.token;
      delete localStorage.user;
    },
  },
  modules: {},
};

export default new Vuex.Store(storeConfig);
