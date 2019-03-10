import Model from './Model';
import {IFrame} from './types';

export default class Game extends Model {
  public score: number = 0;
  public frames: IFrame[] = [];

  private constructor(params: object) {
    super(params);
  }

  public static make(params: object) {
    return new Game(params);
  }
}
