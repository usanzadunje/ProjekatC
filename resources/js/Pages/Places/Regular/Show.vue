<template>
  <div class="w-full">
    <AppHead :title="place.name"/>

    <div
        ref="card"
        class="flex bg-white single-place-card mt-32 mx-auto shadow-lg rounded-3xl"
    >
      <div class="w-1/3 rounded-l-3xl hover:scale-125 transition-transform duration-1000 cursor-pointer">
        <img
            :src="placeLogoPath(place.id)"
            alt="Place logo image"
            class="w-full h-full rounded-l-3xl object-fit object-cover"
        >
      </div>
      <div class="w-2/3 rounded-r-3xl rounded-r-3xl">
        <div class="flex flex-col justify-between h-full px-14 py-7 font-light">
          <div>
            <div class="flex justify-center">
              <h1 class="text-primary-600 text-6xl">
                {{ place.name }}
              </h1>
            </div>
            <div class="flex items-center gap-6 text-2xl mt-16">
              <i class="fas fa-map-marker-alt w-5"></i>
              <span>{{ place.address }}</span>
            </div>
            <div class="mt-4 flex items-center gap-6 text-2xl">
              <i class="fas fa-city w-5"></i>
              <span>{{ place.city }}</span>
            </div>
          </div>
          <div class="flex justify-end gap-2">
            <Link
                :href="route('regular.reservation.store')"
                method="post"
                as="button"
                type="button"
                class="bg-primary-600 hover:bg-primary-900 text-lg text-white font-light rounded-xl w-3/6 py-2.5"
                :data="{place_id: place.id, reservation_date: dayjs().add(getRandomInt(1, 365), 'day').toISOString()}"
            >
              Reserve
            </Link>
            <button
                class="hover:bg-gray-300 text-lg text-black font-light rounded-xl w-3/6 py-2.5"
            >
              Contact
            </button>
          </div>
        </div>
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

import { placeLogoPath } from '@/utils/path';
import { getRandomInt }  from '@/utils/helpers';

import { Place } from '@/types';

export default defineComponent({
  name: 'Places/Regular/Show',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  props: {
    place: {
      type: Object as PropType<Place>,
    },
  },
  setup() {
    return {
      /* Helpers */
      route,
      placeLogoPath,
      dayjs,
      getRandomInt,
    };
  },
});
</script>
<style>
</style>