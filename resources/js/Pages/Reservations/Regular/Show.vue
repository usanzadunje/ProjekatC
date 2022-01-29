<template>
  <div>
    {{ reservation }}
  </div>
</template>

<script lang="ts">
import { defineComponent, PropType } from 'vue';

import dayjs from 'dayjs';

import { Reservation } from '@/types';


export default defineComponent({
  name: 'Reservations/Regular/Show',
  components: {},
  props: {
    reservation: {
      type: Object as PropType<Reservation>,
      required: false,
    },
  },
  setup() {
    /* Component properties */


    /* Lifecycle hooks */


    /* Event handlers */


    return {
      /* Component properties */

      /* Event handlers */
      /* Helpers */
      dayjs,
    };
  },
});
</script>
