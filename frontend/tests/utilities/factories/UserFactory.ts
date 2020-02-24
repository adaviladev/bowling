import * as faker from "faker";
import BuilderInterface from "./BuilderInterface";
import User from "@/Models/User";
import { IUser } from "@/Interfaces/interfaces";

export default class RollFactory implements BuilderInterface {
  generate() {
    const attributes: IUser = {
      id: faker.random.number(),
      first_name: faker.name.firstName(),
      last_name: faker.name.lastName(),
      email: faker.internet.email(),
    };
    return new User(attributes);
  }
}
