import Game from "@/Models/Game";
import {
  mount,
  shallowMount
} from "@vue/test-utils";
import expect from "expect/build/index";
import axios, {
  AxiosInstance,
  AxiosResponse
} from "axios";
import moxios from "moxios";
import Factory from "../../utilities/Factory";
import GameShow from "@/views/PageGameShow.vue";

describe("Showing a game", () => {
  let axiosInstance: AxiosInstance;

  beforeEach(() => {
    // axiosInstance = axios.create();
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

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
      expect(wrapper.vm.$data.game.id).toEqual(game.id);
      expect(wrapper.vm.$data.game.score).toEqual(game.score);
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
