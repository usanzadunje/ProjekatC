<template>
  <div class="px-8 pb-8">
    <AppHead :title="title"/>

    <h1 class="text-4xl font-semibold mt-10">{{ heading }}</h1>

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

    <slot>
    </slot>

    <AppPagination
        v-if="paginator"
        :pagination="paginator.pagination"
        :queries="paginator.queries"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, PropType } from 'vue';

import AppHead       from '@/Shared/AppHead.vue';
import AppSearchBox  from '@/Shared/AppSearchBox.vue';
import AppPagination from '@/Shared/AppPagination.vue';

import { useCustomWatchers } from '@/composables/useCustomWatchers';

import { Paginator } from '@/types';

export default defineComponent({
  name: 'DefaultContainer',
  components: {
    AppHead,
    AppSearchBox,
    AppPagination,
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    heading: {
      type: String,
      required: true,
    },
    paginator: {
      type: Object as PropType<Paginator>,
    },
  },
  emits: ['filterChanged'],
  setup(props, { emit }) {
    /* Component properties */
    const filter = ref<string>('');

    /* Composables */
    const { throttleWatch } = useCustomWatchers();

    /* Watchers */
    throttleWatch(filter, function() {
      emit('filterChanged', filter.value);
    }, 600);
    return {
      filter,
    };
  },
});
</script>