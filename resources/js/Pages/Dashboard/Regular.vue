<template>
  <div class="flex flex-col items-center">
    <AppHead title="Dashboard"/>
    <h1 class="text-3xl text-red-500">USER DASHBOARD</h1>
    <h1 class="text-3xl text-red-500">User: {{ $page.props.auth.user.id }} | {{ $page.props.auth.user.username }}</h1>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Dashboard/Regular',
  components: {
    AppHead,
  },
  layout: Layout,
  setup() {
    return {};
  },
});
</script>