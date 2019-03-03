import GameFactory from './factories/GameFactory';
import BuilderInterface from './factories/BuilderInterface';

type BuilderInterfaceObject = {
  [name: string]: BuilderInterface,
}

export default class Factory
{
  static models: BuilderInterfaceObject = {
    'Game': new GameFactory,
  };

  public static make(modelName: string,
                     attributes: object = {},
                     times: number = 1): BuilderInterface|BuilderInterface[]|void
  {
    let builder = Factory.getBuilder(modelName);
    if (builder) {
      if (times === 1) {
        return Object.assign(builder.generate(), attributes);
      }

      const models: BuilderInterface[] = [];
      for (let i = 0; i < times; i++) {
        models.push(Object.assign(builder.generate(), attributes));
      }

      return models;
    }
  }

  static getBuilder(modelName: string): BuilderInterface
  {
    return Factory.models[modelName] || false;
  }
}
