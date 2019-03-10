interface IGame {
  score: number;
  frames: object[];
}

interface IFrame {
  id: number;
  game_id: number;
  score: number;
  index: number;
  rolls: object[];
  created_at: any;
}

interface IRoll {
  pins: number;
}

export {
  IGame,
  IFrame,
  IRoll,
};
