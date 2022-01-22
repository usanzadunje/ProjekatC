<template>
  <div
      class="relative bg-white rounded-xl h-60 w-full p-8"
  >
    <div class="flex items-center gap-4">
      <PlaceLogo
          :place-id="place.id"
      />

      <span class="font-medium text-primary-600 hover:underline">{{ place.name }}</span>
    </div>

    <div class="text-gray-500 mt-5 font-light">
      <div class="flex items-center gap-4">
        <i class="fas fa-map-marker-alt w-5 text-lg"></i>
        <span>{{ place.address }}</span>
      </div>
      <div class="mt-1 flex items-center gap-4">
        <i class="fas fa-city w-5 text-lg"></i>
        <span>{{ place.city }}</span>
      </div>
    </div>

    <div class="absolute bottom-4 right-7">
      <button
          class="bg-primary-600 hover:bg-primary-900 text-white font-light rounded-full px-4 py-1"
          @click="createReservation"
      >
        Reserve
      </button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Inertia }                   from '@inertiajs/inertia';
import { Link }                      from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import PlaceLogo from '@/Shared/PlaceLogo.vue';

import { todayISO } from '@/utils/date';

import { Place } from '@/types';

export default defineComponent({
  name: 'PlaceCard',
  components: {
    PlaceLogo,
    Link,
  },
  props: {
    place: {
      type: Object as PropType<Place>,
      required: true,
    },
  },
  setup(props) {
    /* Event handlers */
    const createReservation = (e: Event) => {
      e.stopPropagation();

      let routePath: string = route('regular.reservation.store');

      Inertia.post(routePath, {
        place_id: props.place.id as number,
        reservation_date: todayISO(),
      });
    };
    return {
      /* Component properties */
      route,

      /* Event handlers */
      createReservation,

      /* Helpers */
      todayISO,
    };
  },
});
</script>