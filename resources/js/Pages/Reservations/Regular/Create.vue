<template>
  <div>
    <AppHead :title="`${place.name} | Reserve`"/>
    <div class="p-6 min-h-screen bg-indigo-300">
      <div class="w-full max-w-md">
        <Link
            :href="route('regular.reservation.store')"
            method="post"
            as="button"
            type="button"
            class="mt-2 border border-black"
            :data="{place_id: place.id, reservation_date: dayjs().add(getRandomInt(1, 365), 'day').toISOString()}"
        >
          Reserve
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link }                      from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';
import dayjs                         from 'dayjs';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

import { getRandomInt } from '@/utils/helpers';

import { Place } from '@/types';

export default defineComponent({
  name: 'Reservations/Create',
  components: {
    AppHead,
    Link,
  },
  props: {
    place: {
      type: Object as PropType<Place>,
    },
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