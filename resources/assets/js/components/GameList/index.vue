<template>
    <div class="container">
        <h1>Game List</h1>

        <game-list-item
            v-if="games"
            v-for="game in games"
            :game="game"
            :key="game.id"
        >
        </game-list-item>
    </div>
</template>

<script lang="ts" src="./GameList.ts">
</script>

<style></style>
