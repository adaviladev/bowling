import { shallowMount } from "@vue/test-utils/types";
import expect from "expect/build/index";

import Factory from "../utilities/Factory";
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

    expect(wrapper.vm.firstRoll).toEqual(frame.rolls[0].pins);
    expect(wrapper.vm.secondRoll).toEqual(frame.rolls[1].pins);
  });
});
