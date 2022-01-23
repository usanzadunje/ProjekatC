<template>
  <div>
    <AppHead title="Add new client"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <Link
            :href="route('staff.reservation.store')"
            method="post"
            as="button"
            type="button"
            class="mt-2 border border-black"
            :data="{user_id: 10, reservation_date: dayjs().add(getRandomInt(1, 365), 'day').toISOString()}"
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
import dayjs               from 'dayjs';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

import { getRandomInt } from '@/utils/helpers';

export default defineComponent({
  name: 'Reservations/Create',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  setup() {

    return {
      /* Helpers */
      route,
      dayjs,
      getRandomInt,
    };
  },
});
</script>