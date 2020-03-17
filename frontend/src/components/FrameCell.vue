<template>
    <td class="text-center border border-purple-300"
        :class="tenthFrameClass(frameIndex)">
        <div class="w-full border-b border-purple-300">
            {{ frameIndex }}
        </div>
        <div class="flex rolls">
            <div class="roll w-1/2">
                <input
                    v-if="editing"
                    type="text"
                    v-model="frame.rolls[0]"
                    class="appearance-none block border-2 px-2 w-full"
                />
                <span v-else>
                    {{ rollScore(0) }}
                </span>
            </div>
            <div class="roll w-1/2 border-l border-b border-purple-300">
                <input
                    v-if="editing"
                    type="text"
                    v-model="frame.rolls[1]"
                    class="appearance-none block border-2 px-2 w-full"
                />
                <span v-else>
                    {{ rollScore(1) }}
                </span>
            </div>
            <div class="roll w-1/2 border-l border-b border-purple-300"
                v-if="frameIndex === 10"
            >
                <input
                    v-if="editing"
                    type="text"
                    v-model="frame.rolls[2]"
                    class="appearance-none block border-2 px-2 w-full"
                />
                <span v-else>
                    {{ rollScore(2) }}
                </span>
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
import Frame from "@/Models/Frame";
import { Score } from "@/types/Score";

@Component
export default class FrameCell extends Vue {
  @Prop(Frame) private frame!: Frame;

  @Prop(Number) private frameIndex!: number;

  @Prop(Boolean) private editing!: boolean;

  public rollScore(index: number): Score {
    if (this.frame.rolls[index]) {
      return this.frame.rolls[index].pins;
    }

    return '-';
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
