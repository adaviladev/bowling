interface IEntity {
  [key: string]: any;
}

interface IGame extends IEntity {
  id: number | null;
  user_id: number | null;
  score: number;
  frames: IFrame[];
  complete: boolean;
  created_at: any;
}

interface IFrame extends IEntity {
  id: number | null;
  game_id: number | null;
  score: number;
  index: number;
  rolls: IRoll[];
  created_at: any;
}

interface IRoll extends IEntity {
  pins: number;
}

export {
  IEntity,
  IGame,
  IFrame,
  IRoll
};
