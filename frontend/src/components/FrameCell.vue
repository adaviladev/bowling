<template>
    <td class="text-center border border-purple-300"
        :class="tenthFrameClass(frameIndex)">
        <div class="w-full border-b border-purple-300">
            {{ frameIndex }}
        </div>
        <div class="flex">
            <div class="w-1/2">
                {{ firstRoll }}
            </div>
            <div class="w-1/2 border-l border-b border-purple-300">
                {{ secondRoll }}
            </div>
            <div class="w-1/2 border-l border-b border-purple-300"
                v-if="frameIndex === 10"
                >
                {{ secondRoll }}
            </div>
        </div>
        <div class="row text-right">
            <div class="col">
                {{ frame.score }}
            </div>
        </div>
    </td>
</template>

<script lang="ts">
import {
  Component,
  Prop,
  Vue
} from "vue-property-decorator";
import Frame from "@/models/Frame";
import { Score } from "@/models/types";

@Component
export default class FrameCell extends Vue {
  @Prop(Frame) private frame!: Frame;

  @Prop(Number) private frameIndex!: number;

  get firstRoll(): Score {
    if (this.frame.rolls[0]) {
      return this.frame.rolls[0].pins;
    }
    return 0;
  }

  get secondRoll(): Score {
    if (this.frame.rolls[1]) {
      return this.frame.rolls[1].pins;
    }
    return "-";
  }

  public tenthFrameClass(index: number): string {
    if (index === 10) {
      return 'w-2/12';
    }
    return 'w-1/12';
  }
}
</script>

<style scoped></style>
