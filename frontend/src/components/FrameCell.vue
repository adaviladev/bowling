<template>
    <td class="text-center border border-purple-300"
        :class="tenthFrameClass(frameIndex)">
        <div class="roll w-1/2">
            {{ roll.pins }}
        </div>
        <!--
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
        -->
        <div class="row text-right">
            <div class="col">
<!--
                {{ frame.score }}
-->
            </div>
        </div>
    </td>
</template>

<script>
export default {
  props: {
    roll: {
      type: Object,
    },

    frameIndex: {
      type: Number,
    }
  },

  data() {
    return {};
  },

  methods: {
    tenthFrameClass (index) {
      if (index === 10) {
        return 'w-2/12';
      }
      return 'w-1/12';
    }
  }
}
</script>

<style scoped></style>
