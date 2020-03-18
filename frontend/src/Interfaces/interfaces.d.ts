interface IEntity {
  [key: string]: any;
}

interface IGame extends IEntity {
  id: number | null;
  user_id: number | null;
  score: number;
  rolls: IRoll[];
  complete: boolean;
  created_at: any;
}

interface IRoll extends IEntity {
  game_id: number | null;
  pins: number;
}

interface IUser {
  id: number | null;
  first_name: string;
  last_name: string;
  email: string;
}

export {
  IEntity,
  IGame,
  IRoll,
  IUser,
};
