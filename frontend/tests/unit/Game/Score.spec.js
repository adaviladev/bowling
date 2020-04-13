import Game from '@/Models/Game';
import expect from 'expect';
import Factory from "../../utilities/Factory";

describe("Game Scoring", () => {
  it("should_score_a_gutter_game_as_zero", () => {
    const rolls = Factory.make("Roll", { pins: 0 }, 20);
    const game = Game.make();
    game.rolls = rolls;

    expect(game.score).toEqual(0);
  });

  it("should_score_a_game_of_all_ones_as_twenty", () => {
    const rolls = Factory.make("Roll", { pins: 1 }, 20);
    const game = Game.make();
    game.rolls = rolls;
    game.calculateScore();

    expect(game.score).toEqual(20);
  });

  it("should_score_a_game_of_3_and_5_as_8", () => {
    const rolls = [
      Factory.make("Roll", { pins: 3 }),
      Factory.make("Roll", { pins: 5 }),
      ...Factory.make("Roll", { pins: 0 }, 18)
    ];
    const game = Game.make();
    game.rolls = rolls;
    game.calculateScore();

    expect(game.score).toEqual(8);
  });

  it("should_give_a_one_roll_bonus_for_a_spare", () => {
    const rolls = [
      Factory.make("Roll", { pins: 3 }),
      Factory.make("Roll", { pins: 7 }),
      Factory.make("Roll", { pins: 3 }),
      ...Factory.make("Roll", { pins: 0 }, 17)
    ];
    const game = Game.make();
    game.rolls = rolls;
    game.calculateScore();

    expect(game.score).toEqual(16);
  });

  it("should_give_a_two_roll_bonus_for_a_strike", () => {
    const rolls = [
      Factory.make("Roll", { pins: 10 }),
      Factory.make("Roll", { pins: 5 }),
      Factory.make("Roll", { pins: 3 }),
      ...Factory.make("Roll", { pins: 0 }, 17)
    ];
    const game = Game.make();
    game.rolls = rolls;
    game.calculateScore();

    expect(game.score).toEqual(26);
  });

  it("should_give_a_score_of_300_for_a_perfect_game", () => {
    const rolls = Factory.make("Roll", { pins: 10 }, 12);
    const game = Game.make();
    game.rolls = rolls;
    game.calculateScore();

    expect(game.score).toEqual(300);
  });
});
