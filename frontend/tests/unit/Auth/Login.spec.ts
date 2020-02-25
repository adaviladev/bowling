import { createLocalVue, mount } from "@vue/test-utils";
import Vuex from 'vuex';
import expect from "expect";
import moxios from 'moxios';

import Login from '@/views/Login.vue';
import Factory from '../../utilities/Factory';

const localVue = createLocalVue();
localVue.use(Vuex);

describe("<Login/>", () => {
  it('should show the login form', () => {
    let wrapper = mount(Login);

    expect(wrapper.find(Login).exists()).toBe(true);
    expect(wrapper.find('form').exists()).toBe(true);
  });

  it('should update the store with the user and token upon sign in', function(done) {
    const state = {
      user: null,
      token: null,
    };
    const store = new Vuex.Store({
      state
    });
    let wrapper = mount(Login, { store });
    const user = Factory.make('User');

    wrapper.find('#email')
      .setValue('test@example.test');
    wrapper.find('#password')
      .setValue('secret');
    wrapper.find('button[type="submit"]')
      .trigger('click');


    moxios.stubRequest(/api\/login/, {
      response: {
        user,
        token: 'api_token',
      }
    });
    moxios.wait(() => {
      expect(store.state.user).toEqual(user);
      expect(store.state.token).toEqual('api_token');
      done();
    });
  });
});
