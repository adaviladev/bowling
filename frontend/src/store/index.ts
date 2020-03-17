import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
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

export const storeConfig = {
  state,
  mutations: {
    setUser(state: any, user: IUser) {
      state.user = user;
    },
    setToken(state: any, token: string) {
      state.token = token;
    },
    unsetUser(state: any) {
      state.user = null;
    },
    unsetToken(state: any) {
      state.token = null;
    }
  },
  actions: {
    checkLocalStorage({ commit }: any) {
      commit('setUser', JSON.parse(localStorage.user));
      commit('setToken', localStorage.token);

      if (localStorage.token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${(localStorage.token)}`;
      }
    },

    login({ state, commit }: any, payload: any) {
      if (!state.user) {
        commit('setUser', payload.user);
        commit('setToken', payload.token);
        localStorage.user = JSON.stringify(payload.user);
        localStorage.token = payload.token;
      }
    },

    logout({ state, commit }: any) {
      if (state.user) {
        commit('unsetUser');
        commit('unsetToken');
      }

      delete localStorage.token;
      delete localStorage.user;
    }
  },
  modules: {}
};

export default new Vuex.Store(storeConfig);
