interface IEntity {
  [key: string]: any;
}

interface IGame extends IEntity {
  id: number|null;
  userId: number|null;
  score: number;
  frames: IFrame[];
  complete: boolean;
  createdAt: any;
}

interface IFrame extends IEntity {
  id: number|null;
  gameId: number|null;
  score: number;
  index: number;
  rolls: IRoll[];
  createdAt: any;
}

interface IRoll extends IEntity {
  pins: number;
}

export {
  IEntity,
  IGame,
  IFrame,
  IRoll,
};
