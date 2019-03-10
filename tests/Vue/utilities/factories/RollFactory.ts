import faker from 'faker';
import BuilderInterface from './BuilderInterface';
import Roll from '../../../../resources/assets/js/models/Roll';

export default class RollFactory implements BuilderInterface {
  generate() {
    return Roll.make({
      id: faker.random.number(),
      pins: faker.random.number(10),
    });
  }
}
