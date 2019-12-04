<template>
<div class="card">
        <div
            :class="performanceClass"
            class="card-header"
        >
            <h5 class="text-center">{{ game.score }}</h5>
        </div>
        <div class="card-body clearfix">
            <div class="card-text">
                <p>Game #{{ game.id }} - <small>created on {{ game.created_at }}</small></p>
            </div>
            <router-link
                class="btn btn-primary pull-right"
                tag="button"
                :to="{name: 'GameShow', params: {id: game.id}}"
            >
                View Game
            </router-link>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue';
import {
  Component,
  Prop,
} from 'vue-property-decorator';
import {IGame} from '../models/interfaces';

  @Component
export default class GameListItem extends Vue {
    @Prop(Object) public readonly game!: IGame;

    get performanceClass(): string {
      if (this.game.score >= 200) {
        return 'bg-success';
      }
      if (this.game.score >= 100) {
        return 'bg-warning';
      }

      return 'bg-danger';
    }
}
</script>

<style>
</style>
