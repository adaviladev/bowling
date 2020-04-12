import {
  shallowMount,
  Wrapper
} from "@vue/test-utils";
import expect from "expect/build/index";

import Factory from "../../utilities/Factory";
import FrameCell from "@/components/FrameCell.vue";

describe.only("<FrameCell/>", () => {
  const rolls = Factory.make("Roll", { pins: 3 }, 2);

  it("should return the rolls from a provided frame", () => {
    let wrapper = shallowMount(FrameCell, {
      propsData: {
        roll: rolls[0],
        frameIndex: 1,
      }
    });

    let scoreElement = wrapper.find(".roll");

    expect(
      scoreElement
        .findAll(".roll")
        .at(0)
        .text()
    ).toEqual(`${rolls[0].pins}`);
  });
});
