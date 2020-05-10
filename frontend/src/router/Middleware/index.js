import { Route } from 'vue-router';

function isUndefined(value) {
  return value === undefined;
}

/**
 *
 * @param {Function[]} guards
 * @param {Route} to
 * @param {Route} from
 * @param {Function} next
 * @returns {*}
 */
function evaluateGuards(guards, to, from, next) {
  const remainingGuards = guards.slice(0);
  const nextGuard = remainingGuards.shift();

  if (isUndefined(nextGuard)) {
    return next();
  }

  nextGuard(to, from, (nextArgument) => {
    if (isUndefined(nextArgument)) {
      return evaluateGuards(remainingGuards, to, from, next);
    }

    return next(nextArgument);
  });
}

export default function (guards) {
  if (!Array.isArray(guards)) {
    throw new Error('You must specify an array of guards');
  }

  return (to, from, next) => {
    return evaluateGuards(guards, to, from, next);
  };
}
