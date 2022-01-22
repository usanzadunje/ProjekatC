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
            css-classes="bg-white"
            v-model="filter"
        />
      </div>
      <div>
        grid/list view
      </div>
    </div>

    <div>
      <div class="grid grid-cols-fit gap-8 mt-6 pb-8">
        <PlaceCard
            v-for="place in places.data"
            :key="place.id"
            :place="place"
            class="cursor-pointer hover:scale-95 hover:shadow-md"
            @click="Inertia.get(route('regular.place.show', place.id))"
        />
      </div>

      <div
          v-show="places.prev_page_url || places.next_page_url"
          class="relative flex justify-center mt-10 text-xl"
      >
        <div>
          <Link
              :disabled="!places.prev_page_url"
              :href="places.prev_page_url"
              as="button" type="button"
              class="px-6 py-1.5 rounded-l-full border-r-2 border-white bg-gray-600 text-white font-light"
              :class="places.prev_page_url ? ' hover:bg-gray-400' : ''"
          >
            Prev
          </Link>
          <Link
              :disabled="!places.next_page_url"
              :href="places.next_page_url"
              as="button" type="button"
              class="px-6 py-1.5 rounded-r-full bg-gray-600 text-white font-light"
              :class="places.next_page_url ? ' hover:bg-gray-400' : ''"
          >
            Next
          </Link>
        </div>
        <Link
            :href="places.first_page_url"
            as="button" type="button"
            class="absolute left-0 px-6 py-1.5 text-gray-600 hover:text-gray-400 font-semibold underline"
        >
          First page
        </Link>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType, ref } from 'vue';
import { Inertia }                        from '@inertiajs/inertia';
import { Link }                           from '@inertiajs/inertia-vue3';
import route                              from 'ziggy';

import AppHead      from '@/Shared/AppHead.vue';
import Layout       from '@/Shared/Layout.vue';
import PlaceCard    from '@/Shared/PlaceCard.vue';
import AppSearchBox from '@/Shared/AppSearchBox.vue';

import { useCustomWatchers } from '@/composables/useCustomWatchers';

import { Place } from '@/types';

export default defineComponent({
  name: 'Places/Regular/Index',
  components: {
    AppHead,
    Link,
    PlaceCard,
    AppSearchBox,
  },
  layout: Layout,
  props: {
    places: {
      type: Object as PropType<Place[]>,
    },
  },
  setup() {
    /* Component properties */
    const filter = ref<string>('');

    /* Composables */
    const { throttleWatch } = useCustomWatchers();

    /* Watchers */
    throttleWatch(filter, function() {
      Inertia.get(
          route('regular.place.index'),
          { filter: filter.value },
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