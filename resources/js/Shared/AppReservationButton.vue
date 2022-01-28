<template>
  <button
      :disabled="!auth.hasRole('regular')"
      class="bg-primary-600 text-white"
      :class="[auth.hasRole('regular') ? 'hover:bg-primary-900': '', cssClass]"
  >
    Reserve
  </button>
</template>
<script lang="ts">
import { defineComponent } from 'vue';

import useAuth from '@/composables/useAuth';

export default defineComponent({
  name: 'AppReservationButton',
  components: {},
  props: {
    cssClass: {
      type: String,
    },
  },
  setup() {
    /* Composables */
    const { auth } = useAuth();


    return {
      /* Component properties */
      auth,
      /* Event handlers */
    };
  },
});
</script>
<style scoped>
svg {
  height: 1.35em;
}
</style>