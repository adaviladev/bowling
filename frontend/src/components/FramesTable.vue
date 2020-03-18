<template>
    <table
        class="table-auto w-full">
        <tbody>
        <tr class="border border-purple-300">
            <frame-cell v-for="(frame, index) in frames"
                :key="index"
                class="py-0"
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
}
</script>

<style scoped>

</style>
