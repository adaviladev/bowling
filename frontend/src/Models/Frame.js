import Model from "./Model";
import Roll from "./Roll";

export default class Frame extends Model {
  static defaults = {
    created_at: null,
    game_id: null,
    id: null,
    index: 0,
    rolls: [],
    score: 0
  };

  id = null;
  game_id = null;
  rolls = [];
  score = 0;
  index = -1;
  created_at = null;

  constructor(params = Frame.defaults) {
    super();
    this.id = params.id;
    this.game_id = params.game_id;
    this.score = params.score;
    this.index = params.index;
    this.rolls = params.rolls.map(roll => Roll.make(roll));
    this.created_at = params.created_at;
  }

  static make(params) {
    return new Frame(params);
  }
}
