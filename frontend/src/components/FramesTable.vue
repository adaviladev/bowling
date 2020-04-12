<script lang="ts">
import {
  Component,
  Prop,
  Vue
} from "vue-property-decorator";
import Roll from "../Models/Roll";
import FrameCell from "./FrameCell.vue";
import Game from '@/Models/Game';
import { IRoll } from '@/Interfaces/interfaces';

@Component({
  components: {
    FrameCell
  }
})
export default class FramesTable extends Vue {
  @Prop(Array) private rolls!: IRoll[];
  @Prop() public game!: Game;

  private MAX_FRAMES = 10;
}
</script>

<template>
    <table
        class="table-auto w-full">
        <thead>
            <tr>
                <td :key="`frames-${index}`" v-for="index in MAX_FRAMES">
                    {{ index }}
                </td>
            </tr>
        </thead>
        <tbody>
        <tr class="border border-purple-300">
            <frame-cell v-for="(roll, index) in rolls"
                :key="index"
                class="py-0"
                :roll="roll"
                :frameIndex="index + 1"/>
            <td class="border border-purple-300 text-center">
                <div>Total</div>
                {{ game.score }}
            </td>
        </tr>
        </tbody>
    </table>
</template>

<style scoped></style>
