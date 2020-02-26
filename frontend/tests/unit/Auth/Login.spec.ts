import { createLocalVue, mount } from "@vue/test-utils";
import Vuex from 'vuex';
import expect from "expect";

import Login from '@/views/Login.vue';

const localVue = createLocalVue();
localVue.use(Vuex);

describe("<Login/>", () => {
  it('should show the login form', () => {
    let wrapper = mount(Login);

    expect(wrapper.find(Login).exists()).toBe(true);
    expect(wrapper.find('form').exists()).toBe(true);
  });

  it.skip('calls the login action', async (done) => {
    const loginMock = jest.fn(() => Promise.resolve());
    const store = new Vuex.Store({
      actions: {
        login: loginMock,
      }
    });
    let wrapper = mount(Login, { store, localVue });

    wrapper.find('#email')
      .setValue('test@example.test');
    wrapper.find('#password')
      .setValue('secret');
    wrapper.find('button')
      .trigger('click');
    await wrapper.vm.$nextTick();

    expect(loginMock).toHaveBeenCalled();
  });
});
