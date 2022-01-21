<template>
  <AppNav/>
  <div class="flex justify-center">
    <div class="container">
      <slot/>
      <AppFlashMessages/>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AppFlashMessages from '@/Shared/AppFlashMessages.vue';
import AppNav           from '@/Shared/AppNav.vue';

export default defineComponent({
  name: 'Layout',
  components: {
    AppFlashMessages,
    AppNav,
  },
  setup() {


    return {};
  },
});
</script>