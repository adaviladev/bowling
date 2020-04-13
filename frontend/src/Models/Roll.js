import Model from './Model';

export default class Roll extends Model {
  pins = 0;
  game_id = null;

  static defaults = {
    game_id: null,
    pins: 0,
  };

  constructor(params) {
    super();
    const attributes = Object.assign(Roll.defaults, params);
    this.pins = attributes.pins;
    this.game_id = attributes.game_id;
  }

  static make(params = Roll.defaults) {
    return new Roll(params);
  }
}
