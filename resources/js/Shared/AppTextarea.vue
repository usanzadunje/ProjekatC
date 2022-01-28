<template>
  <div class="flex flex-col">
    <label v-if="label" class="text-md font-medium" :for="id">
      <span>{{ label }}</span>
      <span v-if="required" class="text-md text-primary-600 font-semibold">*</span>
    </label>
    <textarea
        ref="input"
        :id="id"
        class="border border-gray-200 rounded-xl mt-2 px-6 py-3 text-primary-600 font-normal"
        :class="{ 'border-red-400': error }"
        :placeholder="placeholder"
        :rows="rows"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        @focus="$emit('focus')"
    />
    <slot></slot>
    <div v-if="error" class="text-red-500">{{ error }}</div>
  </div>
</template>
<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';

import { v4 as uuid } from 'uuid';

export default defineComponent({
  name: 'AppTextarea',
  components: {},
  emits: ['focus', 'update:modelValue'],
  props: {
    label: {
      type: String,
    },
    id: {
      type: String,
      default() {
        return `text-input-${uuid()}`;
      },
    },
    type: {
      type: String,
      default: 'text',
    },
    placeholder: {
      type: String,
    },
    required: {
      type: Boolean,
    },
    autofocus: {
      type: Boolean,
    },
    rows: {
      type: Number,
    },
    error: {
      type: String,
    },
    modelValue: {
      type: String,
    },
  },
  setup(props) {
    const input = ref();

    onMounted(() => {
      // @ts-ignore
      if(props.autofocus) {
        input.value.focus();
      }
    });
    return {
      input,
    };
  },
});
</script>
<style scoped>

</style>