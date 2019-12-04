<template>
    <table data-vue=""
        class="table">
        <!--            <th scope="col">Total</th>-->
        <tbody>
        <tr>
            <FrameCell v-for="(frame, index) in frames"
                :key="index"
                class="py-0"
                :frame="frame"
                :frameIndex="index + 1"/>
            <td class="border">
                <div>Total</div>
                {{ score }}
            </td>
            <td>{{ score }}</td>
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
import Frame from "../models/Frame";
import FrameCell from "./FrameCell.vue";

@Component({
  components: {
    FrameCell
  }
})
export default class FramesTable extends Vue {
  @Prop(Array) private frames!: Frame[];
  @Prop(Number) private score!: number;
}
</script>

<style scoped>

</style>
