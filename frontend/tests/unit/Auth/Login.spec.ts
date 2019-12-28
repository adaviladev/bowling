import { mount } from "@vue/test-utils";
import expect from "expect";

import Login from '@/views/Login.vue';

describe("<Login/>", () => {
  it('should show the login form', () => {
    let wrapper = mount(Login);

    expect(wrapper.find(Login).exists()).toBe(true);
    expect(wrapper.find('form').exists()).toBe(true);
  });
});
