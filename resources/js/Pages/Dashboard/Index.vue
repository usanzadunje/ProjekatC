<template>
  <div>
    <AppHead title="Dashboard"/>
    <h1 class="text-3xl text-red-500">Dashboard</h1>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import AppHead             from '@/Shared/AppHead.vue';
import Layout              from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Dashboard/Index',
  components: {
    AppHead,
  },
  layout: Layout,
  setup() {
    return {};
  },
});
</script>