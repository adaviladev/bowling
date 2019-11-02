import Game from "src/models/Game";
import { mount, shallowMount } from "@vue/test-utils/types";
import expect from "expect/build/index";
import moxios from "moxios";
import Factory from "../utilities/Factory";
import GameShow from "src/pages/PageGameShow.vue";

describe("Showing a game", () => {
  it("should_fetch_a_game_by_id", done => {
    /** @var Game game */
    let game = Factory.make("Game", { id: 1 });
    game.calculateScore();

    const wrapper = shallowMount(GameShow, {
      propsData: {
        id: game.id
      }
    });
    moxios.stubRequest(/api\/games\/.+/, {
      response: {
        game
      }
    });

    moxios.wait(() => {
      expect(wrapper.vm.$data.game).toEqual(game);
      done();
    });
  });

  it("should_render_the_FramesTable_component", () => {
    let game = Factory.make("Game", { id: 42 });
    game.frames = Factory.make("Frame", { gameId: game.id }, 10);
    const wrapper = mount(GameShow, {
      propsData: {
        id: game.id
      }
    });

    expect(wrapper.html()).toContain("game-42-frames");
  });
});
