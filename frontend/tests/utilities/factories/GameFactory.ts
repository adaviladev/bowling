import * as faker from "faker";
import BuilderInterface from "./BuilderInterface";
import Game from "@/models/Game";
import { IGame } from "@/models/interfaces";
import Factory from "../Factory";

export default class GameFactory implements BuilderInterface {
  generate(): Game {
    const gameId = faker.random.number();
    const attributes: IGame = {
      id: gameId,
      user_id: faker.random.number(),
      score: faker.random.number(300),
      complete: faker.random.boolean(),
      frames: Factory.make("Frame", { game_id: gameId }, 10),
      created_at: faker.date.past()
    };
    return Game.make(attributes);
  }
}
