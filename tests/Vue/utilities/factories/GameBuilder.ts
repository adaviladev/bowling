import faker from 'faker';
import BuilderInterface from './BuilderInterface';

export default class GameBuilder implements BuilderInterface {
  generate() {
    return {
      id: faker.random.number(),
      user_id: faker.random.number(),
      score: faker.random.number(300),
      complete: faker.random.boolean(),
    }
  }
}