<template>
  <div class="px-8 pb-8">
    <AppHead title="Places"/>

    <h1 class="text-4xl font-semibold mt-10">Places</h1>

    <div class="grid grid-cols-fit gap-8 mt-6">
      <PlaceCard
          v-for="place in places"
          :key="place.id"
          :place="place"
          class="cursor-pointer hover:scale-95 hover:shadow-md"
          @click="Inertia.get(route('regular.place.show', place.id))"
      />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Inertia }                      from '@inertiajs/inertia';
import { Link }                      from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppHead   from '@/Shared/AppHead.vue';
import Layout    from '@/Shared/Layout.vue';
import PlaceCard from '@/Shared/PlaceCard.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'Places/Regular/Index',
  components: {
    AppHead,
    Link,
    PlaceCard,
  },
  layout: Layout,
  props: {
    places: {
      type: Object as PropType<Place[]>,
    },
  },
  setup() {
    return {
      /* Component properties */
      Inertia,
      route,
    };
  },
});
</script>
<style scoped>
.grid-cols-fit {
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}
</style>