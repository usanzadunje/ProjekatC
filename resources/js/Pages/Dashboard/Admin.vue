<template>
  <div>
    <AppHead title="Dashboard"/>
    <h1 class="text-3xl text-red-500">ADMIN DASHBOARD</h1>
    <input type="button" value="Logout" class="mt-2 border border-black" @click="logout">
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Inertia }         from '@inertiajs/inertia';
import route               from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Dashboard/Admin',
  components: {
    AppHead,
  },
  layout: Layout,
  setup() {
    const logout = () => {
      Inertia.post(route('logout'));
    };
    return {
      logout,
    };
  },
});
</script>