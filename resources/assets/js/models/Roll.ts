import Model from './Model';
import {IRoll} from './types';

export default class Roll extends Model {
  public pins: number = 0;

  public constructor(params: IRoll) {
    super();
    this.pins = params.pins;
  }
}
