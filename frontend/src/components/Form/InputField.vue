<template>
    <label
        :for="forField"
        class="col-sm-4 col-form-label text-md-right"
    >
        {{ label }}
        <input
            :id="forField"
            class="block shadow px-3 py-2 appearance-none rounded w-full mb-4"
            :name="forField"
            :value="value"
            @change="updateValue($event.target.value)"
            required
            autofocus
        >
    </label>
</template>

<script lang="ts">
import Vue from 'vue';
import { Component, Prop } from 'vue-property-decorator';

@Component
export default class InputField extends Vue {
  @Prop(String)
  public label!: string;

  @Prop(String)
  public forField!: string;

  @Prop(String)
  public value!: string;

  public updateValue(value: string) {
    this.$emit('input', value)
  }
}
</script>

<style scoped>

</style>
