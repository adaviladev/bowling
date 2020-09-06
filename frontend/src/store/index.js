import { createStore } from 'vuex';
import { auth } from '@/store/modules/auth.ts';

export const storeConfig = {
  modules: {
    auth
  },
};

export default createStore(storeConfig);
