<template>
    <div class="flex-column">
        <p>Game #{{ game.id }} - {{ game.score }} <small>created on {{ game.created_at }}</small></p>
        <router-link
            :to="{name: 'GameShow', params: {id: game.id}}"
        >
            View Game
        </router-link>
    </div>
</template>

<script lang="ts" src="./GameListItem.ts"></script>

<style>
</style>
