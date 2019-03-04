import { mount, shallowMount } from '@vue/test-utils';
import expect from 'expect';
import Game from '../../../resources/assets/js/models/Game'
import GameListItem from '../../../resources/assets/js/components/GameListItem/index.vue';
import Factory from '../utilities/Factory'
import moxios from 'moxios';

describe('View Game List Item Test', () => {
  beforeEach(() => {
    moxios.install();
  });

  afterEach(() => {
    moxios.uninstall();
  });
});
