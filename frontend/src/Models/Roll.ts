import { IRoll } from "@/Interfaces/interfaces";
import Model from "./Model";

export default class Roll extends Model implements IRoll {
  public pins: number = 0;
  public game_id: number | null = null;

  private static defaults: IRoll = {
    game_id: null,
    pins: 0
  };

  private constructor(params: IRoll) {
    super();
    const attributes = Object.assign(Roll.defaults, params);
    this.pins = attributes.pins;
    this.game_id = attributes.game_id;
  }

  public static make(params: IRoll = Roll.defaults): Roll {
    return new Roll(params);
  }
}
