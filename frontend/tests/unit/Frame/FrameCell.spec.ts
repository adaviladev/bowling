import {
  shallowMount,
  Wrapper
} from "@vue/test-utils";
import expect from "expect/build/index";

import Factory from "../../utilities/Factory";
import FrameCell from "@/components/FrameCell.vue";

describe.only("<FrameCell/>", () => {
  const frame = Factory.make("Frame", {
    rolls: Factory.make("Roll", { pins: 3 }, 2)
  });

  it("should return the rolls from a provided frame", () => {
    let wrapper = shallowMount(FrameCell, {
      propsData: {
        frame,
        frameIndex: 1
      }
    });

    let scoreElement = wrapper.find(".rolls");

    expect(
      scoreElement
        .findAll(".roll")
        .at(0)
        .text()
    ).toEqual(`${frame.rolls[0].pins}`);
    expect(
      scoreElement
        .findAll(".roll")
        .at(1)
        .text()
    ).toEqual(`${frame.rolls[1].pins}`);
  });
});
