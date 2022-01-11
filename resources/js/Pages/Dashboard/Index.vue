<template>
  <div>
    <Head title="Dashboard"/>
    <h1 class="text-3xl text-red-500">Dashboard</h1>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Head, Link }      from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

export default defineComponent({
  components: {
    Head,
    Link,
  },
  setup() {
    return {
      route,
    };
  },
});
</script>