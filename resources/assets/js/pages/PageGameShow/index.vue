<template>
    <div>
        Game #{{ id }}
        <FramesTable
            :data-vue="`game-${id}-frames`"
            :frames="game.frames"
        ></FramesTable>
    </div>
</template>

<script lang="ts" src="./PageGameShow.ts"></script>

<style scoped>

</style>