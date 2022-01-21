<template>
  <div class="px-8 sm:px-4">
    <AppHead title="Places"/>

    <h1 class="text-4xl font-semibold mt-10">Places</h1>


    <div class="flex flex-wrap gap-8 mt-6">
      <div
          v-for="place in places"
          :key="place.id"
          class="bg-white rounded-xl h-60 w-72 grow"
      >

      </div>
    </div>
    {{ places }}
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import { Link }                      from '@inertiajs/inertia-vue3';
import route                         from 'ziggy';

import AppHead from '@/Shared/AppHead.vue';
import Layout  from '@/Shared/Layout.vue';

import { Place } from '@/types';

export default defineComponent({
  name: 'Places/Regular/Index',
  components: {
    AppHead,
    Link,
  },
  layout: Layout,
  props: {
    places: {
      type: Object as PropType<Place[]>,
    },
  },
  setup() {
    return {
      route,
    };
  },
});
</script>