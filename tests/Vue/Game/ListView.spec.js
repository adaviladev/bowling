import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect';
import GameList from '../../../resources/assets/js/components/GameList/index.vue';
import Game from '../../../resources/assets/js/models/Game'
import GameListItem from '../../../resources/assets/js/components/GameListItem/index.vue';
import Factory from '../utilities/Factory'
import moxios from 'moxios';

describe('View Game List Test', () => {
  let wrapper;
  beforeEach(() => {
    moxios.install();
    wrapper = mount(GameList, {
      stubs: ['router-link']
    });
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('should_render_the_GameList_component', () => {
    expect(wrapper.html())
      .toContain('Game List');
  });

  it('should_fetch_a_list_of_games_from_the_API_on_mount', function(done) {
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
    wrapper.vm.$data.games = Factory.make('Game', {}, 3);

    expect(wrapper.findAll(GameListItem).length).toBe(3)
  })
});
