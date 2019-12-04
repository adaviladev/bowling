<template>
    <div>
        <h1>Create a Game</h1>
        <GameEditor/>
    </div>
</template>

<script lang="ts">
import {
  Component,
  Vue
} from "vue-property-decorator";
import GameEditor from "@/components/GameEditor.vue";

@Component({
  components: {
    GameEditor
  }
})
export default class PageGameCreate extends Vue {}
</script>

<style scoped></style>
