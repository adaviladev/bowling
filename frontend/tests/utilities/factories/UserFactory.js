import * as faker from "faker";
import User from "@/Models/User";

export default class RollFactory {
  generate() {
    const attributes = {
      id: faker.random.number(),
      first_name: faker.name.firstName(),
      last_name: faker.name.lastName(),
      email: faker.internet.email(),
    };
    return new User(attributes);
  }
}
