<template>
    <table
        class="table-auto w-full">
        <tbody>
        <tr class="border border-purple-300">
            <frame-cell v-for="(frame, index) in frames"
                :key="frameKey(index)"
                class="py-0"
                :editing="editing"
                :frame="frame"
                :frameIndex="index + 1"/>
            <td class="border border-purple-300 text-center">
                <div>Total</div>
                {{ game.score }}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script lang="ts">
import {
  Component,
  Prop,
  Vue
} from "vue-property-decorator";
import Frame from "../Models/Frame";
import FrameCell from "./FrameCell.vue";
import Game from '@/Models/Game';

@Component({
  components: {
    FrameCell
  }
})
export default class FramesTable extends Vue {
  @Prop(Array) private frames!: Frame[];
  @Prop() public game!: Game;
  @Prop() public editing!: boolean;

  public frameKey(index: number): string {
    return `frame-${index}`;
  }
}
</script>

<style scoped>

</style>
