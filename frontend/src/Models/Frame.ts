import {
  IFrame,
  IRoll
} from "@/Interfaces/interfaces";
import Model from "./Model";
import Roll from "./Roll";

export default class Frame extends Model implements IFrame {
  [key: string]: any;

  public static defaults: IFrame = {
    created_at: null,
    game_id: null,
    id: null,
    index: 0,
    rolls: [],
    score: 0
  };

  public id: number | null = null;
  public game_id: number | null = null;
  public rolls: IRoll[] = [];
  public score: number = 0;
  public index: number = -1;
  public created_at: any = null;

  public constructor(params: IFrame = Frame.defaults) {
    super();
    this.id = params.id;
    this.game_id = params.game_id;
    this.score = params.score;
    this.index = params.index;
    this.rolls = params.rolls.map(roll => new Roll(roll as IRoll));
    this.created_at = params.created_at;
  }

  public static make(params: IFrame): IFrame {
    return new Frame(params);
  }
}
