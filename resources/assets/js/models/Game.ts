import Model from './Model';
import {
  IFrame,
  IGame,
} from './types';

export default class Game extends Model {
  public static defaults: IGame = {
    complete: false,
    createdAt: null,
    frames: [],
    id: null,
    score: 0,
    userId: null,
  };

  public id: number|null = null;
  public score: number = 0;
  public frames: IFrame[] = [];
  public complete: boolean = false;
  public createdAt: any = null;

  public constructor(params: IGame = Game.defaults) {
    super();
    this.id = params.id;
    this.score = params.score;
    this.frames = params.frames as IFrame[];
    this.complete = params.complete;
    this.createdAt = params.createdAt;
  }
}
