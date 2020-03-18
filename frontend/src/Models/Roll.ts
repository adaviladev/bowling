import { IRoll } from "@/Interfaces/interfaces";
import Model from "./Model";

export default class Roll extends Model implements IRoll {
  public pins: number;
  public game_id: number | null;

  private static defaults: IRoll = {
    pins: 0,
    game_id: null,
  };

  private constructor(params: IRoll) {
    super();
    const attributes = Object.assign(Roll.defaults, params);
    this.pins = attributes.pins;
    this.game_id = attributes.game_id;
  }

  public static make(params: IRoll = Roll.defaults) {
    return new Roll(params);
  }
}
