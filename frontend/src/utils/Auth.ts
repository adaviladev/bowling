import store from '@/store';

export class Auth {
  public static guest(): boolean {
    return !this.check();
  }

  public static check(): boolean {
    return store.state.user !== null;
  }
}
