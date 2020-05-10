import { Auth } from '@/utils/Auth';

/**
 *
 * @param {string} permission
 * @returns {Function}
 */
export const can = (permission) => (to, from, next) => {
  if (Auth.check() && !Auth.user().can(permission)) {
    return next(from);
  }
  return next();
};
