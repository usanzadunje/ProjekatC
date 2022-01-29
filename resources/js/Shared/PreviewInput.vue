<template>
  <div>
    <span class="font-medium text-primary-600 text-xl">{{ label }}</span>
    <div class="text-lg bg-white w-max px-6 py-2 mt-2 rounded-full flex">
      <div class="pr-2 border-r">
        <i :class="icon" v-if="icon"></i>
        <slot name="icon"></slot>
      </div>
      <div class="pl-2">
        <span v-if="content">{{ content }}</span>
        <slot></slot>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'PreviewInput',
  components: {},
  props: {
    label: {
      type: String,
    },
    content: {
      type: null,
    },
    icon: {
      type: String,
    },
  },
  setup() {
    return {};
  },
});
</script>
