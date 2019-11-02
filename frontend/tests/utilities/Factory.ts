import GameFactory from "./factories/GameFactory";
import RollFactory from "./factories/RollFactory";
import BuilderInterface from "./factories/BuilderInterface";
import FrameFactory from "./factories/FrameFactory";
import Model from "../../src/models/Model";

type BuilderInterfaceObject = {
  [name: string]: BuilderInterface;
};

export default class Factory {
  static models: BuilderInterfaceObject = {
    Game: new GameFactory(),
    Frame: new FrameFactory(),
    Roll: new RollFactory()
  };

  public static make(modelName: string, attributes: object = {}, times: number = 1): any | any[] {
    let builder = Factory.getBuilder(modelName);
    if (builder) {
      if (times === 1) {
        return Object.assign(builder.generate(), attributes);
      }

      const models: Model[] = [];
      for (let i = 0; i < times; i++) {
        models.push(Object.assign(builder.generate(), attributes));
      }

      return models;
    }
  }

  static getBuilder(modelName: string): BuilderInterface {
    return Factory.models[modelName] || false;
  }
}
