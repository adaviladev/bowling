const testUtils = require('@vue/test-utils');
const expect = require('expect');
const GameList = require('../../../resources/assets/js/components/GameList/index.vue');
const moxios = require('moxios');

describe('GameList', () => {
  // beforeEach(() => {
  //   moxios.install(axios);
  // });
  //
  // afterEach(() => {
  //   moxios.uninstall(axios);
  // });

  it('renders a list of games', () => {
    let wrapper = testUtils.shallowMount(GameList);

    expect(wrapper.html())
      .toContain('Game List');
  });
});
