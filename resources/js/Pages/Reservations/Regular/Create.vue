<template>
  <div>
    <AppHead title="Add new client"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <Link
            :href="route('regular.reservation.store')"
            method="post"
            as="button"
            type="button"
            class="mt-2 border border-black"
            :data="{place_id: 2, reservation_date: todayISO()}"
        >
          Reserve
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import { Link }            from '@inertiajs/inertia-vue3';
import route               from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

import { todayISO } from '@/utils/date';

export default defineComponent({
  name: 'Reservations/Create',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  setup() {

    return {
      route,
      todayISO,
    };
  },
});
</script>