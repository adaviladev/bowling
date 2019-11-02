import {
  shallowMount
} from '@vue/test-utils/types'
import expect from 'expect/build/index';

import PageGameCreate from '@/pages/PageGameCreate.vue';

describe('<PageGameCreate/>', () => {
  it('it should show the GameCreate component', () => {
    let wrapper = shallowMount(PageGameCreate);

    expect(wrapper.find(PageGameCreate).exists()).toBe(true);
  });
});