<template>
    <td class="text-center border border-purple-300"
        :class="tenthFrameClass(frameIndex)">
        <div class="w-full border-b border-purple-300">
            {{ frameIndex }}
        </div>
        <div class="flex rolls">
            <div class="roll w-1/2">
                {{ rollScore(0) }}
            </div>
            <div class="roll w-1/2 border-l border-b border-purple-300">
                {{ rollScore(1) }}
            </div>
            <div class="roll w-1/2 border-l border-b border-purple-300"
                v-if="frameIndex === 10"
            >
                {{ rollScore(2) }}
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
import { Score } from "@/types/Score";
import { IRoll } from '@/Interfaces/interfaces';

@Component
export default class FrameCell extends Vue {
  @Prop(Array) private rolls!: IRoll[];

  @Prop(Number) private frameIndex!: number;

  public rollScore(index: number): Score {
    if (this.rolls[index]) {
      return this.rolls[index].pins;
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
