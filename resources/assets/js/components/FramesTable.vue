<template>
    <table data-vue="" class="table">
        <thead>
        <tr>
            <th
                v-for="index in Array(MAX_FRAMES).keys()"
                scope="col"
                :key="index + 1"
                class="text-right"
            >
                {{ index + 1 }}
            </th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td
                v-for="(frame, index) in frames"
                :key="index"
                class="py-0"
            >
                <div
                    class="row text-center"
                >
                    <div
                        v-for="roll in frame.rolls"
                        class="col"
                    >
                        {{ roll.pins }}
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col">
                        {{ frame.score }}
                    </div>
                </div>
            </td>
            <td>{{ score }}</td>
        </tr>
        </tbody>
    </table>
</template>

<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import Frame from '../models/Frame';

  @Component
  export default class FramesTable extends Vue {
    @Prop(Array) private frames!: Frame[];
    @Prop(Number) private score!: number;
    private MAX_FRAMES: number = 10;
  }
</script>

<style scoped>

</style>