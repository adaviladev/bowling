import { shallowMount } from '@vue/test-utils';
import expect from 'expect';

import PageGameCreate from '@/views/PageGameCreate.vue';

describe('<PageGameCreate/>', () => {
  it('it should show the GameCreate component', () => {
    let wrapper = shallowMount(PageGameCreate);

    expect(wrapper.find(PageGameCreate).exists()).toBe(true);
  });
});
