<template>
  <div>
    <div class="flex h-screen bg-primary-100 p-4 sm:p-16 md:py-16 md:px-44">
      <div
          class="w-full h-full xl:w-1/2 flex flex-col items-center justify-between px-8 sm:px-28 md:px-44 bg-white rounded-l-xl">
        <slot name="left"></slot>
      </div>
      <div class="hidden xl:block w-1/2">
        <slot name="right"></slot>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'AuthLayout',
  components: {},
  setup() {
    return {};
  },
});
</script>