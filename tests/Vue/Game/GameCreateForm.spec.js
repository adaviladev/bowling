import {
  mount,
} from '@vue/test-utils'
import expect from 'expect';
import moxios from 'moxios';
import PageGameCreate from '@/pages/PageGameCreate.vue'
import GameEditor from '@/components/GameEditor'
import Factory from '../utilities/Factory'

describe('<PageGameCreate/>', () => {
  const GAME_SUBMIT_ID = '#game-store';

  beforeEach(() => {
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });

  it('should show the game create form', () => {
    let wrapper = mount(PageGameCreate);

    expect(wrapper.find('form#game-create').exists()).toBe(true);
    expect(wrapper.find(GAME_SUBMIT_ID).exists()).toBe(true);
  });

  // it('should send a POST request to the game create endpoint when the submit button is clicked', () => {
  //   const game = Factory.make('Game');
  //   let wrapper = mount(GameEditor);
  //
  //   wrapper.find(GAME_SUBMIT_ID).trigger('click');
  //   moxios.stubRequest(/api\/games/, {
  //     response: {
  //       game,
  //     }
  //   });
  //
  //   // moxios.wait(() => {
  //   //   let request = moxios.requests.mostRecent();
  //   //   expect(wrapper.vm.game.id).toBe(game.id)
  //   //   done();
  //   // });
  // });
});
