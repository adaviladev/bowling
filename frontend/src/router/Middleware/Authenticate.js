import { Auth } from '@/utils/Auth';
import { Route } from 'vue-router';

/**
 *
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 * @returns {Function}
 */
export const auth = (to, from, next) => {
  if (Auth.guest()) {
    return next({
      name: 'Login',
    });
  }
  return next();
};
