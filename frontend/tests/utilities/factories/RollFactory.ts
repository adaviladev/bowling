import * as faker from "faker";
import BuilderInterface from "./BuilderInterface";
import Roll from "@/Models/Roll";
import { IRoll } from "@/Interfaces/interfaces";

export default class RollFactory implements BuilderInterface {
  generate() {
    const attributes: IRoll = {
      id: faker.random.number(),
      pins: faker.random.number(10)
    };
    return new Roll(attributes);
  }
}
