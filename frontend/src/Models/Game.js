import Model from './Model';
import Frame from '@/Models/Frame';
import Roll from '@/Models/Roll';

export default class Game extends Model {
  static defaults = {
    complete: false,
    created_at: null,
    id: null,
    score: 0,
    user_id: null,

    frames: [],
    rolls: new Array(20).fill(Roll.make()),
  };

  MAX_FRAMES = 10;

  constructor(params) {
    super();
    const attributes = Object.assign(Game.defaults, params);
    this.id = attributes.id;
    this.user_id = attributes.user_id;
    this.score = attributes.score;
    this.complete = attributes.complete;
    this.created_at = attributes.created_at;

    this.frames = (attributes.frames || []).map(frame => Frame.make(frame));
    this.rolls = attributes.rolls.map(roll => Roll.make(roll));
  }

  static make(params = {}) {
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
