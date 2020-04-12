import Game from "@/Models/Game";
import {
  mount,
  shallowMount,
  createLocalVue
} from "@vue/test-utils";
import expect from "expect/build/index";
import axios from "axios";
import moxios from "moxios";
import VueRouter from 'vue-router';
import Factory from "../../utilities/Factory";
import GameShow from "@/views/PageGameShow.vue";

describe("Showing a game", () => {
  let axiosInstance;

  beforeEach(() => {
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it("should_fetch_a_game_by_id", done => {
    /** @var Game game */
    let game = Factory.make("Game", { id: 1 });
    game.calculateScore();

    const localVue = createLocalVue();
    localVue.use(VueRouter);
    moxios.stubRequest(/api\/games\/\d+/, {
      response: {
        game
      }
    });
    const wrapper = shallowMount(GameShow, {
      localVue,
      propsData: {
        id: game.id
      },
    });
    moxios.wait(() => {
      expect(wrapper.vm.$data.game.id).toEqual(game.id);
      expect(wrapper.vm.$data.game.score).toEqual(game.score);
      done();
    });

  });

  it("should_render_the_FramesTable_component", (done) => {
    let game = Factory.make("Game", { id: 42 });
    game.frames = Factory.make("Frame", { gameId: game.id }, 10);
    moxios.stubRequest(/api\/games\/\d+/, {
      response: {
        game
      }
    });
    const localVue = createLocalVue();
    localVue.use(VueRouter);
    const wrapper = mount(GameShow, {
      localVue,
      propsData: {
        id: game.id
      },
    });
    moxios.wait(() => {
      expect(wrapper.html()).toContain("game-42-frames");
      done();
    });

  });
});
