<template>
    <div>
        <h1>Create a Game</h1>
        <GameEditor/>
    </div>
</template>

<script lang="ts">
import GameEditor from "@/components/GameEditor.vue";

export default {
  component: {
    GameEditor,
  }
}
</script>

<style scoped></style>
