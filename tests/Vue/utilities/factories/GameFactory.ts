import * as faker from 'faker';
import BuilderInterface from './BuilderInterface';
import Game from '../../../../resources/assets/js/models/Game';
import {IGame} from '../../../../resources/assets/js/models/types';
import Factory from '../Factory';

export default class GameFactory implements BuilderInterface {
  generate(): Game {
    const gameId = faker.random.number();
    const attributes: IGame = {
      id: gameId,
      userId: faker.random.number(),
      score: faker.random.number(300),
      complete: faker.random.boolean(),
      frames: Factory.make('Frame', {gameId: gameId}, 10),
      createdAt: faker.date.past()
    };
    return new Game(attributes);
  }
}