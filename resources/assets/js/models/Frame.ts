import Model from './Model';
import {
  IFrame,
  IRoll,
} from './types';

export default class Frame extends Model {
  public static defaults: IFrame = {
    createdAt: null,
    gameId: null,
    id: null,
    index: 0,
    rolls: [],
    score: 0,
  };

  public id: number|null = null;
  public gameId: number = -1;
  public rolls: IRoll[] = [];
  public score: number = 0;
  public index: number = -1;
  public createdAt: any = null;

  public constructor(params: IFrame = Frame.defaults) {
    super();
    this.id = params.id;
    this.gameId = params.game_id;
    this.score = params.score;
    this.index = params.index;
    this.rolls = params.rolls;
    this.createdAt = params.created_at;
  }
}
