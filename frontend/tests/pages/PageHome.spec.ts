import {
    mount,
} from '@vue/test-utils/types';
import expect from 'expect/build/index';
import PageHome from '@/pages/PageHome.vue'

describe('View Home Page Test', () => {
    it('should_render_the_home_page', () => {
        let wrapper = mount(PageHome);

        expect(wrapper.find('.home-page').exists()).toBe(true);
    })
});
