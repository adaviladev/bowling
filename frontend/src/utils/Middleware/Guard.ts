import { Auth } from '@/utils/Auth';
import { Route } from 'vue-router';

export const isAuthenticated = (to: Route, from: Route, next: Function): Function => {
  if (Auth.guest()) {
    return next({
      name: 'Login',
    });
  }
  return next();
};
