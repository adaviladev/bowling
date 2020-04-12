import Model from "./Model";
import Frame from '@/Models/Frame';
import Roll from '@/Models/Roll';

export default class Game extends Model {
  static defaults = {
    complete: false,
    created_at: null,
    frames: [],
    rolls: [],
    id: null,
    score: 0,
    user_id: null
  };

  user_id = null;

  id = null;
  score = 0;
  frames = [];
  rolls = [];
  complete = false;
  created_at = null;

  MAX_FRAMES = 10;

  constructor(params) {
    super();
    this.id = params.id;
    this.user_id = params.user_id;
    this.score = params.score;
    this.frames = (params.frames || []).map(frame => Frame.make(frame));
    this.rolls = (params.rolls || []).map(roll => Roll.make(roll));
    this.complete = params.complete;
    this.created_at = params.created_at;
  }

  static make(params = Game.defaults) {
    return new Game(params);
  }

  calculateScore() {
    const rolls = this.rolls;
    let total = 0;
    let roll = 0;
    for (let i = 0; i < this.MAX_FRAMES; i++) {
      if (Game.isStrike(rolls, roll)) {
        total += Game.strikeBonus(rolls, roll);
        roll++;
      } else if (Game.isSpare(rolls, roll)) {
        total += Game.spareBonus(rolls, roll);
        roll += 2;
      } else {
        total += rolls[roll].pins + rolls[roll + 1].pins;
        roll += 2;
      }
    }
    this.score = total;
  }

  static isStrike(rolls, index) {
    return rolls[index].pins === 10;
  }

  static strikeBonus(rolls, index) {
    return 10 + rolls[index + 1].pins + rolls[index + 2].pins;
  }

  static isSpare(rolls, index) {
    return rolls[index].pins + rolls[index + 1].pins === 10;
  }

  static spareBonus(rolls, index) {
    return 10 + rolls[index + 2].pins;
  }
}
