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

<script>
export default {
  props: {
    label: {
      required: true,
      type: String,
    },

    forField: {
      required: true,
      type: String,
    },

    value: {
      required: true,
      type: String,
    },
  },

  methods: {
    updateValue (value: string) {
      this.$emit('input', value)
    }
  }
}
</script>

<style scoped>

</style>
