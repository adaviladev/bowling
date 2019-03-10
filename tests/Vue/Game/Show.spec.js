import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect'
import moxios from 'moxios';
import axios from 'axios';
import Factory from '../utilities/Factory'
import GameShow from '../../../resources/assets/js/pages/PageGameShow/index.vue';

describe('Showing a game', () => {
  before(() => {
    moxios.install(axios);
  });

  after(() => {
    moxios.uninstall(axios);
  });

  it('should_fetch_a_game_by_id', (done) => {
    let game = Factory.make('Game', {id: 1});
    const wrapper = shallowMount(GameShow, {
      propsData: {
        id: game.id,
      },
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

  it('should_render_the_FramesTable_component', () => {
    let game = Factory.make('Game', {id: 42});
    game.frames = Factory.make('Frame', {game_id: game.id}, 10);
    const wrapper = mount(GameShow, {
      propsData: {
        id: game.id
      },
      data() {
        return {
          game
        };
      },
    });

    expect(wrapper.html()).toContain('game-42-frames');
  });
});
