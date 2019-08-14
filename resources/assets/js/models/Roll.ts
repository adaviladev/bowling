import {IRoll} from './interfaces';
import Model from './Model';

export default class Roll extends Model implements IRoll {
  public pins: number = 0;

  public constructor(params: IRoll) {
    super();
    this.pins = params.pins;
  }
}
