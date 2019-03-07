import faker from 'faker';
import BuilderInterface from './BuilderInterface';
import Frame from '../../../../resources/assets/js/models/Frame';

export default class FrameFactory implements BuilderInterface {
  generate() {
    return Frame.make({
      id: faker.random.number(),
      game_id: faker.random.number(),
      score: faker.numberBetween(10),
      index: faker.numberBetween(10),
      created_at: faker.date.past()
    });
  }
}