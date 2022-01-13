<template>
  <div>
    <AppHead title="Welcome"/>
    <h1 class="text-3xl text-red-500">Welcome to Projekat C</h1>
    <Link :href="route('login')" as="button" type="button" class="mt-2 border border-black">Login</Link>
    <Link :href="route('register')" as="button" type="button" class="mt-2 border border-black">Register</Link>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link }            from '@inertiajs/inertia-vue3';

import Layout from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Welcome',
  components: {
    Link,
  },
  layout: Layout,
  setup() {


    return {};
  },
});
</script>