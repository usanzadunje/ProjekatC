<template>
  <div>
    <AppHead :title="place.name"/>

    {{ place }}
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
      route,
    };
  },
});
</script>