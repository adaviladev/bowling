<template>
    <div class="card w-1/3 px-2 my-2">
        <div class="shadow">
            <div :class="performanceClass"
                class="px-6 py-4">
                <h5 class="text-center">{{ game.score }}</h5>
            </div>
            <div class="px-6 py-4">
                <div class="font-bold py-4">
                    <p>
                        Game #{{ game.id }} -
                        <small>created on {{ game.created_at }}</small>
                    </p>
                </div>
                <router-link class="btn btn-primary text-white"
                    tag="button"
                    :to="{ name: 'GameShow', params: { id: game.id } }">
                    View Game
                </router-link>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from "vue";
import {
  Component,
  Prop
} from "vue-property-decorator";
import { IGame } from "../models/interfaces";

@Component
export default class GameListItem extends Vue {
  @Prop(Object) public readonly game!: IGame;

  get performanceClass(): string {
    if (this.game.score >= 200) {
      return "bg-green-300";
    }
    if (this.game.score >= 100) {
      return "bg-yellow-300";
    }

    return "bg-red-300";
  }
}
</script>

<style></style>
