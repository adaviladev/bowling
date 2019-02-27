import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect';
import GameList from '../../../resources/assets/js/components/GameList/index.vue';
import GameListItem from '../../../resources/assets/js/components/GameListItem/index.vue';
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
    let wrapper = shallowMount(GameList);

    expect(wrapper.html())
      .toContain('Game List');
  });

  it('should_fetch_a_list_of_games_from_the_API_on_mount', function(done) {
    let wrapper = mount(GameList);
    moxios.stubRequest('/games', {
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
});
