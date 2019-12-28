import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    token: null,
  },
  mutations: {
    setUser(state, user) {
      state.user = user;
    },
    setToken(state, token) {
      state.token = token;
    }
  },
  actions: {
    login({ state, commit }, payload) {
      if (!state.user) {
        commit('setUser', payload.user);
        commit('setToken', payload.token);
      }
    }
  },
  modules: {}
});
