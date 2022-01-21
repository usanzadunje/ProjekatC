<template>
  <div
      class="bg-white rounded-xl h-60 w-full p-8"
  >
    <div class="flex items-center gap-4">
      <PlaceLogo
          :place-id="place.id"
      />

      <span class="font-medium text-primary-600 hover:underline">{{ place.name }}</span>
    </div>

    <div class="flex flex-col items-start text-gray-500 mt-5">
      <div class="flex items-center gap-4">
        <i class="fas fa-map-marker-alt w-5 text-lg"></i>
        <span>{{ place.address }}</span>
      </div>
      <div class="mt-1 flex items-center gap-4">
        <i class="fas fa-city w-5 text-lg"></i>
        <span>{{ place.city }}</span>
      </div>
    </div>

    <div class="mt-4 flex justify-end">
      <div
          class="bg-primary-600 hover:bg-primary-900 text-white rounded-full px-4 py-1"
          @click="createReservation($event, route('regular.reservation.create', place.id))"
      >
        Reserve
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Inertia }                   from '@inertiajs/inertia';
import route                         from 'ziggy';

import PlaceLogo from '@/Shared/PlaceLogo.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'PlaceCard',
  components: {
    PlaceLogo,
  },
  props: {
    place: {
      type: Object as PropType<Place>,
      required: true,
    },
  },
  setup() {
    /* Event handlers */
    const createReservation = (e: Event, route: string) => {
      e.stopPropagation();

      Inertia.get(route);
    };
    return {
      /* Component properties */
      route,

      /* Event handlers */
      createReservation,
    };
  },
});
</script>