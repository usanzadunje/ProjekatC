<template>
  <div class="flex justify-center">
    <div class="container flex justify-center">
      <slot/>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  name: 'Layout',
  components: {},
  setup() {


    return {};
  },
});
</script>