<template>
  <div class="px-8 pb-8">
    <AppHead title="Places"/>

    <h1 class="text-4xl font-semibold mt-10">Places</h1>

    <div class="flex justify-between items-center mt-6">
      <div class="flex items-center gap-4">
        <div>
          SORT
        </div>
        <AppSearchBox
            css-classes="bg-white py-2.5 w-46"
            v-model="filter"
        />
      </div>
      <div>
        grid/list view
      </div>
    </div>

    <div>
      <div class="grid grid-cols-fit gap-5 mt-6 pb-8">
        <PlaceCard
            v-for="place in places.data"
            :key="place.id"
            :place="place"
            class="cursor-pointer hover:scale-95 hover:shadow-md"
            @click="Inertia.get(route('regular.place.show', place.id))"
        />
      </div>

      <AppPagination
          :pagination="{prev_page_url: places.prev_page_url, next_page_url: places.next_page_url, first_page_url: route('regular.place.index')}"
          :queries="filterQuery"
      />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref }    from 'vue';
import { Inertia, RequestPayload } from '@inertiajs/inertia';
import route                       from 'ziggy';

import AppHead       from '@/Shared/AppHead.vue';
import Layout        from '@/Shared/Layout.vue';
import PlaceCard     from '@/Shared/PlaceCard.vue';
import AppSearchBox  from '@/Shared/AppSearchBox.vue';
import AppPagination from '@/Shared/AppPagination.vue';

import { useCustomWatchers } from '@/composables/useCustomWatchers';

export default defineComponent({
  name: 'Places/Regular/Index',
  components: {
    AppHead,
    PlaceCard,
    AppSearchBox,
    AppPagination,
  },
  layout: Layout,
  props: {
    places: {
      type: Object,
    },
  },
  setup() {
    /* Component properties */
    const filter = ref<string>('');
    const filterQuery = ref<RequestPayload>();

    /* Composables */
    const { throttleWatch } = useCustomWatchers();

    /* Watchers */
    throttleWatch(filter, function() {
      filterQuery.value = filter.value ? { filter: filter.value } : {};

      Inertia.get(
          route('regular.place.index'),
          filterQuery.value,
          {
            only: ['places'],
            replace: true,
            preserveState: true,
          },
      );
    }, 600);

    return {
      /* Component properties */
      filter,
      filterQuery,
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