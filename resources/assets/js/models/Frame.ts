export default class Frame {
  private constructor(params: object) {
    for (const key in params) {
      this[key] = params[key];
    }
  }

  public static make(params: object) {
    return new Frame(params);
  }
}
