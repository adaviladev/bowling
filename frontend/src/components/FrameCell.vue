<template>
    <td class="text-center">
        <div class="row border">
            <div class="col">
                {{ frameIndex }}
            </div>
        </div>
        <div class="row scores">
            <div class="col border">
                {{ firstRoll }}
            </div>
            <div class="col border">
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
import { Component, Prop, Vue } from "vue-property-decorator";
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
}
</script>

<style scoped></style>
