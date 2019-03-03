import faker from 'faker';
import BuilderInterface from './BuilderInterface';
import Game from '../../../../resources/assets/js/models/Game';

export default class GameFactory implements BuilderInterface {
  generate() {
    return Game.make({
      id: faker.random.number(),
      user_id: faker.random.number(),
      score: faker.random.number(300),
      complete: faker.random.boolean(),
      created_at: faker.date.past()
    });
  }
}