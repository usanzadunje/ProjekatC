<template>
  <div>
    <AppHead title="Users"/>
    <h1 class="text-3xl text-red-500">Reservations Index</h1>

    <div>
      {{ reservations }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';
import AppHead                       from '@/Shared/AppHead.vue';
import Layout                        from '@/Shared/Layout.vue';

import { Reservation } from '@/types';

export default defineComponent({
  name: 'Reservations/Regular/Index',
  components: {
    AppHead,
  },
  layout: Layout,
  props: {
    reservations: {
      type: Object as PropType<Reservation[]>,
    },
  },
  setup() {
    return {};
  },
});
</script>