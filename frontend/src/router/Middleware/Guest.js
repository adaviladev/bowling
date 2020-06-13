import { Auth } from '@/utils/Auth';
import { Route } from 'vue-router';

/**
 *
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 * @returns {Function}
 */
export const guest = (to, from, next) => {
  if (Auth.check()) {
    return next(from);
  }
  return next();
};
