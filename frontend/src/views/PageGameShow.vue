<script lang="ts">
import axios from "axios";
import FramesTable from "@/components/FramesTable.vue";
import Game from "@/Models/Game";
import { computed, defineComponent, reactive, ref } from 'vue';

export default defineComponent({
  components: {
    FramesTable,
  },

  props: ['id'],

  setup (props, context) {
    let game = ref(Game.make());
    axios.get(`/api/games/${props.id}`).then(({ data }) => {
      game.value = Game.make(data.game);
    });

    const rolls = computed(() => game.value.rolls);
    return {
      game,
      rolls,
    };
  },
})
</script>

<template>
    <div class="m-auto w-10/12">
        Game #{{ game.id }}
        <FramesTable v-if="game"
            :data-vue="`game-${game.id}-frames`"
            :game="game"
            :rolls="game.rolls"/>
    </div>
</template>

<style scoped></style>
