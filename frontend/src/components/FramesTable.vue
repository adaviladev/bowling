<script>
import FrameCell from "./FrameCell.vue";

export default {
  components: {
    FrameCell,
  },

  props: {
    rolls: {
      type: Array,
    },

    game: {
      type: Object,
    },

    editing: {
      type: Boolean,
    }
  },

  data: () => {
    return {
      maxFrames: 10,
    };
  },
}
</script>

<template>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <td :key="`frames-${index}`"
                v-for="index in maxFrames">
                {{ index }}
            </td>
        </tr>
        </thead>
        <tbody>
        <tr class="border border-purple-300">
            <frame-cell v-for="(roll, index) in rolls"
                :key="index"
                class="py-0"
                :editing="editing"
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
