<template>
  <div class="flex justify-center">
    <div class="container flex justify-center">
      <slot/>
      <AppFlashMessages/>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AppFlashMessages from '@/Shared/AppFlashMessages.vue';

export default defineComponent({
  name: 'Layout',
  components: {
    AppFlashMessages,
  },
  setup() {


    return {};
  },
});
</script>