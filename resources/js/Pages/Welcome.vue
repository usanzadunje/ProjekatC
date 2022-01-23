<template>
  <div>
    <AppHead title="Welcome"/>
    <h1 class="text-3xl text-red-500">Welcome to Projekat C</h1>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Welcome',
  components: {
    AppHead,
  },
  layout: Layout,
  setup() {


    return {};
  },
});
</script>