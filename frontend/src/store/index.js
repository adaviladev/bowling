import Vue from "vue";
import Vuex from "vuex";

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
};

export default new Vuex.Store(storeConfig);
