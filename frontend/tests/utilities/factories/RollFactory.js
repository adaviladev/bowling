import * as faker from "faker";
import Roll from "@/Models/Roll";

export default class RollFactory {
  generate() {
    const attributes = {
      id: faker.random.number(),
      game_id: faker.random.number(),
      pins: faker.random.number(10),
    };
    return Roll.make(attributes);
  }
}
