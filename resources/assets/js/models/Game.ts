import Model from './Model';
import {
  IFrame,
  IGame,
  IRoll,
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

  private MAX_FRAMES: number = 10;

  public constructor(params: IGame = Game.defaults) {
    super();
    this.id = params.id;
    this.score = params.score;
    this.frames = params.frames as IFrame[];
    this.complete = params.complete;
    this.createdAt = params.createdAt;
  }

  public calculateScore() {
    const frames = this.frames;
    if (!frames.length) {
      return 0;
    }
    const rolls: IRoll[] = this.rolls;
    let total = 0;
    let roll = 0;
    for (let i = 0; i < this.MAX_FRAMES; i++) {
      if (rolls[roll].pins === 10) {
        total += 10 + rolls[roll + 1].pins + rolls[roll + 2].pins;
        roll++;
      } else if (rolls[roll].pins + rolls[roll + 1].pins === 10) {
        total += 10 + rolls[roll + 2].pins;
        roll += 2;
      } else {
        total += rolls[roll].pins + rolls[roll + 1].pins;
        roll += 2;
      }
      this.frames[i].score = total;
    }
    this.score = total;
  }

  private get rolls(): IRoll[] {
    return this.frames.reduce((accumulator: IRoll[], frame: IFrame) => {
      return accumulator.concat(frame.rolls);
    }, [] as IRoll[]);
  }
}
