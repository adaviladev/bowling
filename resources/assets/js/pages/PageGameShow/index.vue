<template>
    <div>
        Game #{{ id }}
        <FramesTable
            v-if="game"
            :data-vue="`game-${id}-frames`"
            :frames="frames"
        ></FramesTable>
    </div>
</template>

<script lang="ts" src="./PageGameShow.ts"></script>

<style scoped>

</style>