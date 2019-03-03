export default class Game {
  private constructor(params: object) {
    for (const key in params) {
      this[key] = params[key];
    }
  }

  public static make(params: object) {
    return new Game(params);
  }
}
