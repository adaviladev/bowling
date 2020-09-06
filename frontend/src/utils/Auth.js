import { store } from '@/store';

export class Auth {
  /**
   * @returns {boolean}
   */
  static guest() {
    return !this.check();
  }

  /**
   * @returns {boolean}
   */
  static check() {
    return store.state.auth.user !== null;
  }

  static user() {
    if (store.state.auth.user !== null) {
      return store.state.auth.user;
    }

    return null;
  }

  /**
   * @returns {number | null}
   */
  static id() {
    const user = Auth.user();
    if (user) {
      return user.id;
    }

    return null;
  }
}
