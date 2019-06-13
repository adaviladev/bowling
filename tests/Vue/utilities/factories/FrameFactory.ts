import * as faker  from 'faker';
import BuilderInterface from './BuilderInterface';
import Frame from '../../../../resources/assets/js/models/Frame';
import Factory from '../Factory';
import {IFrame} from '../../../../resources/assets/js/models/interfaces';

export default class FrameFactory implements BuilderInterface {
  generate() {
    const attributes: IFrame = {
      id: faker.random.number(),
      game_id: faker.random.number(),
      score: faker.random.number(10),
      index: faker.random.number(10),
      rolls: Factory.make('Roll', {}, 2),
      created_at: faker.date.past()
    };
    return new Frame(attributes);
  }
}
