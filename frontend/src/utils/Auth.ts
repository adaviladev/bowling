import store from '@/store';
import { IUser } from '@/Interfaces/interfaces';

export class Auth {
  public static guest(): boolean {
    return !this.check();
  }

  public static check(): boolean {
    return store.state.user !== null;
  }

  public static user(): IUser | null {
    if (store.state.user !== null) {
      return store.state.user;
    }

    return null;
  }

  public static id(): number | null {
    const user = this.user();
    if (user) {
      return user.id;
    }

    return null;
  }
}
