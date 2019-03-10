<template>
    <div class="container">
        <h1>Game List</h1>

        <div class="card-columns">
            <GameListItem v-if="games"
                          v-for="game in games"
                          :game="game"
                          :key="game.id"
            ></GameListItem>
        </div>
    </div>
</template>

<script lang="ts"
        src="./GameList.ts"
></script>

<style></style>
