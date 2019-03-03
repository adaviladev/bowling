<template>
    <div class="container">
        <h1>Game List</h1>

        <GameListItem
            v-if="games"
            v-for="game in games"
            :game="game"
            :key="game.id"
        >
        </GameListItem>
    </div>
</template>

<script lang="ts" src="./GameList.ts">
</script>

<style></style>
