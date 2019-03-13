<template>
    <div>
        Game #{{ id }}
        <FramesTable
            v-if="game"
            :data-vue="`game-${id}-frames`"
            :frames="game.frames"
            :score="game.score"
        ></FramesTable>
    </div>
</template>

<script lang="ts" src="./PageGameShow.ts"></script>

<style scoped>

</style>