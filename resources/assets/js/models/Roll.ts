import Model from './Model';

export default class Roll extends Model {
  public static make(params: object) {
    return new Roll(params);
  }
}
