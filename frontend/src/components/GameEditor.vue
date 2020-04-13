<template>
    <form id="game-create"
        @submit.prevent="saveGame">
        <frames-table
            :editing="true"
            :game="game"
            :rolls="game.rolls"
        />

        <button class="btn btn-primary"
            id="game-store"
            type="submit">
            Create
        </button>
    </form>
</template>

<script>
import axios from "axios";
import FramesTable from "@/components/FramesTable.vue";
import Game from "@/Models/Game";
import Frame from '@/Models/Frame';

export default {
  components: {
    FramesTable,
  },

  data() {
    return {
      game: Game.make(),
    };
  },

  methods: {
    saveGame() {
      axios
        .post('/api/games', {
          game: this.game,
        })
        .then((response) => {
          // console.log("response:", response);
          // this.game = Game.make(response.data.game as IGame);
          // console.log(this.game);
        });
    }
  }
}
</script>

<style scoped></style>
