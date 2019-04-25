import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect';
import GameList from '@/components/GameList.vue';
import Game from '@/models/Game'
import GameListItem from '@/components/GameListItem.vue';
import Factory from '../utilities/Factory'
import moxios from 'moxios';

describe('View Game List Test', () => {
  beforeEach(() => {
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('should_render_the_GameList_component', () => {
    let wrapper = mount(GameList, {
      stubs: ['router-link']
    });
    expect(wrapper.html())
      .toContain('Game List');
  });

  it('should_fetch_a_list_of_games_from_the_API_on_mount', function(done) {
    let wrapper = mount(GameList, {
      stubs: ['router-link']
    });
    moxios.stubRequest('/api/games', {
      response: {
        games: Factory.make('Game', {}, 3)
      },
      status: 200,
    });

    moxios.wait(() => {
      expect(wrapper.vm.$data.games.length).toBe(3);
      done();
    });
  });

  it('should_render_a_GamesListItem_component_for_each_game', function() {
    let wrapper = mount(GameList, {
      stubs: ['router-link']
    });
    wrapper.vm.$data.games = Factory.make('Game', {}, 3);

    expect(wrapper.findAll(GameListItem).length).toBe(3)
  })
});
