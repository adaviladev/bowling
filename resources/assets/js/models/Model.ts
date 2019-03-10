export default class Model {
  public constructor(params: object) {
    for (const key in params) {
      this[key] = params[key];
    }
  }

  public static make(params: object) {
    return new Model(params);
  }
}
