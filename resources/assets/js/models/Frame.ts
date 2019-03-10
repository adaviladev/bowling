import Model from './Model';
import {IFrame} from './types';

export default class Frame extends Model {
  public rolls: object[] = [];

  private constructor(params: IFrame) {
    super(params);
    this.rolls = params.rolls;
  }

  public static make(params: IFrame): object {
    return new Frame(params);
  }
}
