<template>
  <DefaultContainer
      title="Places"
      heading="Places"
      :paginator="
      {
        pagination: {
          prev_page_url: places.prev_page_url,
          next_page_url: places.next_page_url,
          first_page_url: route('regular.place.index')
        },
        queries: filterQuery
      }"
      class="px-8 pb-8"
      @filter-changed="fetchPlaces"
  >
    <div class="grid grid-cols-fit gap-5 mt-6 pb-8">
      <PlaceCard
          v-for="place in places.data"
          :key="place.id"
          :place="place"
          class="cursor-pointer hover:scale-95 hover:shadow-md"
          @click="Inertia.get(route('regular.place.show', place.id))"
      />
    </div>
  </DefaultContainer>
</template>

<script lang="ts">
import { defineComponent, ref }    from 'vue';
import { Inertia, RequestPayload } from '@inertiajs/inertia';
import route                       from 'ziggy';

import Layout           from '@/Shared/Layout.vue';
import DefaultContainer from '@/Shared/DefaultContainer.vue';
import PlaceCard        from '@/Shared/PlaceCard.vue';

export default defineComponent({
  name: 'Places/Regular/Index',
  components: {
    DefaultContainer,
    PlaceCard,
  },
  layout: Layout,
  props: {
    places: {
      type: Object,
    },
  },
  setup() {
    /* Component properties */
    const filterQuery = ref<RequestPayload>();

    /* Composables */

    /* Event handlers */
    const fetchPlaces = (filter: string) => {
      filterQuery.value = filter ? { filter } : {};

      Inertia.get(
          route('regular.place.index'),
          filterQuery.value,
          {
            only: ['places'],
            replace: true,
            preserveState: true,
          },
      );
    };

    return {
      /* Component properties */
      filterQuery,

      /* Component properties */
      fetchPlaces,

      /* Helpers */
      Inertia,
      route,
    };
  },
});
</script>