<template>
    <div class="container">
        <h1>Game List</h1>

        <div class="card-columns" v-if="games">
            <game-list-item
                :game="game"
                :key="game.id"
                v-for="game in games"
            ></game-list-item>
        </div>
    </div>
</template>

<script lang="ts">
import axios, { AxiosResponse } from "axios";
import Vue from "vue";
import { Component } from "vue-property-decorator";

import GameListItem from "@/components/GameListItem.vue";
import Game from "@/models/Game";
import { IGame } from "@/models/interfaces";

@Component({
    components: {
        GameListItem
    }
})
export default class GameList extends Vue {
    public games: Game[] = [];

    public created(): void {
        axios
            .get("/api/games")
            .then((response: AxiosResponse) => {
                this.games = response.data.games.map((game: object) =>
                    Game.make(game as IGame)
                );
            })
            .catch((error: AxiosResponse) => {});
    }
}
</script>

<style></style>
