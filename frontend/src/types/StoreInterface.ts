export interface AuthState {
  authenticated: boolean;
  token: string | null;
  user: object | null;
}

export interface StoreInterface {
  auth: AuthState;
}