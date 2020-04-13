import GameFactory from "./factories/GameFactory";
import RollFactory from "./factories/RollFactory";
import UserFactory from "./factories/UserFactory";

export default class Factory {
  static models = {
    Game: new GameFactory(),
    Roll: new RollFactory(),
    User: new UserFactory(),
  };

  static make(modelName, attributes = {}, times = 1) {
    let builder = Factory.getBuilder(modelName);
    if (builder) {
      if (times === 1) {
        return Object.assign(builder.generate(), attributes);
      }

      const models = [];
      for (let i = 0; i < times; i++) {
        models.push(Object.assign(builder.generate(), attributes));
      }

      return models;
    }
  }

  static getBuilder(modelName) {
    return Factory.models[modelName] || false;
  }
}
