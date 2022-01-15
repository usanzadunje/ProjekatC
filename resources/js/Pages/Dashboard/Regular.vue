<template>
  <div>
    <AppHead title="Dashboard"/>
    <h1 class="text-3xl text-red-500">USER DASHBOARD</h1>
    <h1 class="text-3xl text-red-500">User: {{ $page.props.auth.user.id }} | {{ $page.props.auth.user.username }}</h1>
    <Link :href="route('regular.reservation.index')" as="button" type="button" class="mt-2 border border-black">
      All Reservations
    </Link>
    <Link :href="route('regular.reservation.create')" as="button" type="button" class="mt-2 border border-black">
      Create Reservation
    </Link>
    <Link :href="route('logout')" method="post" as="button" type="button" class="mt-2 border border-black">Logout</Link>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link }            from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

export default defineComponent({
  name: 'Dashboard/Regular',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  setup() {
    return {
      route,
    };
  },
});
</script>