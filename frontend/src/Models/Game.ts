import {
  IGame,
  IRoll
} from "@/Interfaces/interfaces";
import Model from "./Model";
import Roll from '@/Models/Roll';

export default class Game extends Model implements IGame {
  public static defaults: IGame = {
    complete: false,
    created_at: null,
    rolls: [],
    id: null,
    score: 0,
    user_id: null
  };

  public user_id!: number | null;

  public id: number | null = null;
  public score: number = 0;
  public rolls: IRoll[] = [];
  public complete: boolean = false;
  public created_at: any = null;

  private MAX_FRAMES: number = 10;

  private constructor(params: IGame) {
    super();
    this.id = params.id;
    this.user_id = params.user_id;
    this.score = params.score;
    this.rolls = (params.rolls || []).map(roll => Roll.make(roll));
    this.complete = params.complete;
    this.created_at = params.created_at;
  }

  public static make(params: IGame = Game.defaults): Game {
    return new Game(params);
  }

  public calculateScore() {
    const rolls: IRoll[] = this.rolls;
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

  private static isStrike(rolls: IRoll[], index: number): boolean {
    return rolls[index].pins === 10;
  }

  private static strikeBonus(rolls: IRoll[], index: number): number {
    return 10 + rolls[index + 1].pins + rolls[index + 2].pins;
  }

  private static isSpare(rolls: IRoll[], index: number): boolean {
    return rolls[index].pins + rolls[index + 1].pins === 10;
  }

  private static spareBonus(rolls: IRoll[], index: number): number {
    return 10 + rolls[index + 2].pins;
  }
}
