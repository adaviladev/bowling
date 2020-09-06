import { Module } from 'vuex';
import User from '@/Models/User';
import { AuthState } from "@/types/StoreInterface";

interface RootState {
  auth: AuthState;
}

const state: AuthState = {
  user: null,
  token: null,
  authenticated: false,
};

export const auth: Module<AuthState, RootState> = {
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
    login({ state, commit }, payload) {
      if (!state.user) {
        commit('setUser', User.make(payload.user));
        commit('setToken', payload.token);
      }
    },

    logout({ state, commit }) {
      if (state.user) {
        commit('unsetUser');
        commit('unsetToken');
      }
    },
  },
};