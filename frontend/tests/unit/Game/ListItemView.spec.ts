import { mount, RouterLinkStub } from "@vue/test-utils";
import expect from "expect/build/index";
import GameListItem from "@/components/GameListItem.vue";
import Factory from "../../utilities/Factory";

describe("View Game List Item Test", () => {
  it("should_show_a_link_to_a_specific_game", function() {
    const game = Factory.make("Game");
    let wrapper = mount(GameListItem, {
      propsData: {
        game
      },
      stubs: {
        RouterLink: RouterLinkStub
      }
    });

    expect(wrapper.find(RouterLinkStub).props().to).toEqual({
      name: "GameShow",
      params: {
        id: game.id
      }
    });
  });

  it("should_render_a_card_component_for_each_list_item", () => {
    const game = Factory.make("Game");
    let wrapper = mount(GameListItem, {
      propsData: {
        game
      },
      stubs: {
        RouterLink: RouterLinkStub
      }
    });

    expect(wrapper.find(".card").exists()).toBe(true);
  });
});
