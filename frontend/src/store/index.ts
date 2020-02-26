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
    login({ state, commit }: any, payload: any) {
      if (!state.user) {
        commit('setUser', payload.user);
        commit('setToken', payload.token);
      }
    },

    logout({ state, commit }: any) {
      if (state.user) {
        commit('unsetUser');
        commit('unsetToken');
      }
    }
  },
  modules: {}
};

export default new Vuex.Store(storeConfig);
