<template>
    <div class="m-auto w-10/12">
        Game #{{ game.id }}
        <FramesTable v-if="game"
            :data-vue="`game-${game.id}-frames`"
            :game="game"
            :rolls="game.rolls"/>
    </div>
</template>

<script>
import axios from "axios";
import FramesTable from "@/components/FramesTable.vue";
import Game from "@/Models/Game";

export default {
  components: {
    FramesTable,
  },

  data () {
    return {
      game: Game.make(),
    };
  },

  created () {
    axios.get(`/api/games/${this.$route.params.id}`).then(({ data }) => {
      this.game = Game.make(data.game);
      this.game.calculateScore();
    });
  },

  computed: {
    rolls () {
      return this.game.rolls;
    }
  }
}
</script>

<style scoped></style>
