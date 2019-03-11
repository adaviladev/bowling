import * as faker  from 'faker';
import BuilderInterface from './BuilderInterface';
import Frame from '../../../../resources/assets/js/models/Frame';
import Factory from '../Factory';
import {IFrame} from '../../../../resources/assets/js/models/types';

export default class FrameFactory implements BuilderInterface {
  generate() {
    const attributes: IFrame = {
      id: faker.random.number(),
      gameId: faker.random.number(),
      score: faker.random.number(10),
      index: faker.random.number(10),
      rolls: Factory.make('Roll', {}, 2),
      createdAt: faker.date.past()
    };
    return new Frame(attributes);
  }
}