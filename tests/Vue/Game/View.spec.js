import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect';
import GameList from '../../../resources/assets/js/components/GameList/index.vue';
import moxios from 'moxios';

describe('GameList', () => {
  beforeEach(() => {
    moxios.install(axios);
  });

  afterEach(() => {
    moxios.uninstall(axios);
  });

  it('renders a list of games', () => {
    let wrapper = shallowMount(GameList);

    expect(wrapper.html())
      .toContain('Game List');
  });
});
